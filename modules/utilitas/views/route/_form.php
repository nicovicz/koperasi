<?php
use yii\helpers\Html;
use app\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-form">

 

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
  		'pluginOptions' => [
  			'onText' => 'On',
  			'offText' => 'Off',
  		]
  	]) ?>

   

    <?php ActiveForm::end(); ?>

</div>
