<?php

use yii\helpers\Html;
use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'type')->textInput() ?>

    <?php $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'created_at')->textInput() ?>

    <?php $form->field($model, 'updated_at')->textInput() ?>

   

    <?php ActiveForm::end(); ?>

</div>
