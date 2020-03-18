<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DtPinjamanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dt-pinjaman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_trx') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'bunga') ?>

    <?= $form->field($model, 'tenor') ?>

    <?php // echo $form->field($model, 'status_trx') ?>

    <?php // echo $form->field($model, 'mst_anggota_id') ?>

    <?php // echo $form->field($model, 'mst_jenis_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
