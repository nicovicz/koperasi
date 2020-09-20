<?php
namespace app\helpers;

use Yii;
use hscstudio\mimin\models\Route;
use hscstudio\mimin\models\RouteSearch;
use hscstudio\mimin\components\Configs;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use yii\caching\TagDependency;

class RouteGenerator
{

    public function actionGenerate($role,$authManager)
	{
		$routes = $this->searchRoute('all');
		foreach ($routes as $route => $status) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				
				if (!Route::findOne($route)) {
					$model = new Route();
					$model->name = $route;
					$pos = (strrpos($route, '/'));
					$model->type = substr($route, 1, $pos - 1);
					$model->alias = substr($route, $pos + 1, 64);
					$model->save();
					
					if ($model->alias != '*'){
						$permission = $authManager->createPermission($model->name);
						$authManager->add($permission);
						$authManager->addChild($role, $permission);
					}
					
					
				}
				$transaction->commit();
			}catch(\Exception $e) {
				if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
					// This should be specific to SQLite, sleep for 0.25 seconds
					// and try again.  We do have to commit the open transaction first though
					$transaction->commit();
					usleep(250000);
				} else {
					$transaction->rollBack();
					throw $e;
				}
			}
		}
	
    }
    
    public function searchRoute($target, $term = '', $refresh = '0')
	{
		if ($refresh == '1') {
			$this->invalidate();
		}
		$result = [];
		$manager = Yii::$app->getAuthManager();

		$exists = array_keys($manager->getPermissions());
		$routes = $this->getAppRoutes();
		if ($target == 'available') {
			foreach ($routes as $route) {
				if (in_array($route, $exists)) {
					continue;
				}
				if (empty($term) or strpos($route, $term) !== false) {
					$result[$route] = true;
				}
			}
		} else if ($target == 'all') {
			foreach ($routes as $route) {
				$available = 0;
				if (in_array($route, $exists)) {
					$available = 1;
				}
				if (empty($term) or strpos($route, $term) !== false) {
					$result[$route] = $available;
				}
			}
		} else {
			foreach ($exists as $name) {
				if ($name[0] !== '/') {
					continue;
				}
				if (empty($term) or strpos($name, $term) !== false) {
					$r = explode('&', $name);
					$result[$name] = !empty($r[0]) && in_array($r[0], $routes);
				}
			}
		}

		//Yii::$app->response->format = 'json';
		return $result;
	}

	/**
	 * Get list of application routes
	 * @return array
	 */
	public function getAppRoutes()
	{
		$key = __METHOD__;
		$cache = Configs::instance()->cache;
		if ($cache === null || ($result = $cache->get($key)) === false) {
            $result = [];
            $config = require __DIR__ . '/../config/web.php';
            $Yiiapp = new \yii\web\Application($config);
			$this->getRouteRecrusive($Yiiapp, $result);
			if ($cache !== null) {
				$cache->set($key, $result, Configs::instance()->cacheDuration, new TagDependency([
					'tags' => self::CACHE_TAG
				]));
			}
		}

		return $result;
	}

	/**
	 * Get route(s) recrusive
	 * @param \yii\base\Module $module
	 * @param array $result
	 */
	private function getRouteRecrusive($module, &$result)
	{
		$token = "Get Route of '" . get_class($module) . "' with id '" . $module->uniqueId . "'";
		Yii::beginProfile($token, __METHOD__);
		try {
			foreach ($module->getModules() as $id => $child) {
				if (($child = $module->getModule($id)) !== null) {
					$this->getRouteRecrusive($child, $result);
				}
			}

			foreach ($module->controllerMap as $id => $type) {
				$this->getControllerActions($type, $id, $module, $result);
			}

			$namespace = trim($module->controllerNamespace, '\\') . '\\';
			$this->getControllerFiles($module, $namespace, '', $result);
			$result[] = ($module->uniqueId === '' ? '' : '/' . $module->uniqueId) . '/*';
		} catch (\Exception $exc) {
			Yii::error($exc->getMessage(), __METHOD__);
		}
		Yii::endProfile($token, __METHOD__);
	}

	/**
	 * Get list controller under module
	 * @param \yii\base\Module $module
	 * @param string $namespace
	 * @param string $prefix
	 * @param mixed $result
	 * @return mixed
	 */
	private function getControllerFiles($module, $namespace, $prefix, &$result)
	{
		$path = @Yii::getAlias('@' . str_replace('\\', '/', $namespace));
		$token = "Get controllers from '$path'";
		Yii::beginProfile($token, __METHOD__);
		try {
			if (!is_dir($path)) {
				return;
			}
			foreach (scandir($path) as $file) {
				if ($file == '.' || $file == '..') {
					continue;
				}
				if (is_dir($path . '/' . $file)) {
					$this->getControllerFiles($module, $namespace . $file . '\\', $prefix . $file . '/', $result);
				} elseif (strcmp(substr($file, -14), 'Controller.php') === 0) {
					$id = Inflector::camel2id(substr(basename($file), 0, -14));
					$className = $namespace . Inflector::id2camel($id) . 'Controller';
					if (strpos($className, '-') === false && class_exists($className) && is_subclass_of($className, 'yii\base\Controller')) {
						$this->getControllerActions($className, $prefix . $id, $module, $result);
					}
				}
			}
		} catch (\Exception $exc) {
			Yii::error($exc->getMessage(), __METHOD__);
		}
		Yii::endProfile($token, __METHOD__);
	}

	/**
	 * Get list action of controller
	 * @param mixed $type
	 * @param string $id
	 * @param \yii\base\Module $module
	 * @param string $result
	 */
	private function getControllerActions($type, $id, $module, &$result)
	{
		$token = "Create controller with cofig=" . VarDumper::dumpAsString($type) . " and id='$id'";
		Yii::beginProfile($token, __METHOD__);
		try {
			/* @var $controller \yii\base\Controller */
			$controller = Yii::createObject($type, [$id, $module]);
			$this->getActionRoutes($controller, $result);
			$result[] = '/' . $controller->uniqueId . '/*';
		} catch (\Exception $exc) {
			Yii::error($exc->getMessage(), __METHOD__);
		}
		Yii::endProfile($token, __METHOD__);
	}

	/**
	 * Get route of action
	 * @param \yii\base\Controller $controller
	 * @param array $result all controller action.
	 */
	private function getActionRoutes($controller, &$result)
	{
		$token = "Get actions of controller '" . $controller->uniqueId . "'";
		Yii::beginProfile($token, __METHOD__);
		try {
			$prefix = '/' . $controller->uniqueId . '/';
			foreach ($controller->actions() as $id => $value) {
				$result[] = $prefix . $id;
			}
			$class = new \ReflectionClass($controller);
			foreach ($class->getMethods() as $method) {
				$name = $method->getName();
				if ($method->isPublic() && !$method->isStatic() && strpos($name, 'action') === 0 && $name !== 'actions') {
					$result[] = $prefix . Inflector::camel2id(substr($name, 6));
				}
			}
		} catch (\Exception $exc) {
			Yii::error($exc->getMessage(), __METHOD__);
		}
		Yii::endProfile($token, __METHOD__);
	}
}