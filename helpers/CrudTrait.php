<?php

namespace app\helpers;

use Yii;
use yii\web\NotFoundHttpException;

trait CrudTrait
{
    use \app\helpers\AuthGuardTrait;

    public function actionIndex()
    {
        $searchModel = new $this->modelSearchClass();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new $this->modelClass();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()){
                Yii::$app->session->setFlash('success',self::messages['SUCCESS_SAVE']);
                return $this->redirect(['index']);
            }
            
            Yii::$app->session->setFlash('error',self::messages['FAIL_SAVE']);
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                Yii::$app->session->setFlash('success',self::messages['SUCCESS_UPDATE']);
                return $this->redirect(['index']);
            }
            
            Yii::$app->session->setFlash('error',self::messages['FAIL_UPDATE']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()){
            Yii::$app->session->setFlash('success',self::messages['SUCCESS_DELETE']);
        }else{
            Yii::$app->session->setFlash('error',self::messages['FAIL_DELETE']);
        }

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
