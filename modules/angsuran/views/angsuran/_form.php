<?php

use yii\helpers\Html;
use app\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\DtAngsuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dt-angsuran-form">

    <?php $form = ActiveForm::begin(); ?>

   

   

    <?= $form->field($model, 'tgl_trx')->widget(DatePicker::class,[
        'pluginOptions' => [
            'orientation' => 'bottom',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>
  


    <?php ActiveForm::end(); ?>

</div>
