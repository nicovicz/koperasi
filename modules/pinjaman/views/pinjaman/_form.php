<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\DtPinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dt-pinjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mst_anggota_id')->widget(Select2::class,[
        'theme' => Select2::THEME_BOOTSTRAP,
        'options'=>[
            'placeholder'=>'Pilih Anggota Koperasi'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => Url::to(['/api/anggota']),
            ],

        ]

    ]) ?>

    <?= $form->field($model, 'tgl_trx')->widget(DatePicker::class,[
        'pluginOptions' => [
            'orientation' => 'bottom',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoClose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

   

    <?= $form->field($model, 'tenor')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>
