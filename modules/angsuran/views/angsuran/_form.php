<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DtAngsuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dt-angsuran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dt_pinjaman_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'angsuran_pokok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'angsuran_bunga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'angsuran_ke')->textInput() ?>

    <?= $form->field($model, 'tgl_trx')->textInput() ?>

    <?= $form->field($model, 'status_trx')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
