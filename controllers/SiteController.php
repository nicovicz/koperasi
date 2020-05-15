<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\MstAnggota;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public $layout='//login';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '//main';
        return $this->render('index');
    }

    public function actionProfile()
    {
        $this->layout = '//main';
        return $this->render('profile');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPreview($id)
    {
        if (($model = MstAnggota::findOne($id)) === null) {
           
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        if (empty($model->foto)){
            $path = Yii::getAlias('@uploadAnggota').'/no.png';
        }else{
            $path = $model->getUploadDir().$model->foto;
        }
        
       
        return Yii::$app->response->sendFile($path, $model->nip, ['inline' => true])->send();
    }

    
}
