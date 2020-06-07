<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\MstAnggota;
use yii\web\NotFoundHttpException;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;

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

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Silahkan Cek Email Anda');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Maaf Tidak Dapat Mengirim Reset Password Ke Email Anda');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Password Baru Sudah Disimpan.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

   

    
}
