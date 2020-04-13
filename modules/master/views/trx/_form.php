<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MstTrx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mst-trx-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

   

    <?php ActiveForm::end(); ?>

</div>
