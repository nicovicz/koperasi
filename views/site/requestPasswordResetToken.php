<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reset Password Akun';
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1><hr/>

    <p>Masukan Email Akun Anda</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                    <?=Html::a('Kembali',Url::to(['/site/login']),['class'=>'btn btn-warning text-white']);?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>