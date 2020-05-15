<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Panel;
use app\helpers\Ref;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\DtSimpananSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Panel::begin([
    'title'=>'Pencarian Data Pinjaman',
    'icon'=>'fa fa-filter'
]);?>
<div class="dt-simpanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="col-lg-2">
    <?= $form->field($model, 'nip')->label(false)->textInput([
        'placeholder'=>'NIP Pegawai'
    ]); ?>
    </div>
    <div class="col-lg-2">   
    <?= $form->field($model, 'nama')->label(false)->textInput([
        'placeholder'=>'Nama Pegawai'
    ]);?>
    </div>

    

    <div class="col-lg-2">      
    <?= $form->field($model, 'unit')->label(false)->dropDownList(Ref::getUnit(),[
        'prompt'=>'Unit'
    ]) ?>
    </div>

    <div class="col-lg-2">      
    <?= $form->field($model, 'sub_bagian')->label(false)->textInput([
        'placeholder'=>'Unit Kerja'
    ]); ?>
    </div>

    <div class="col-lg-2">      
    <?= $form->field($model, 'tgl_trx')->label(false)->widget(DatePicker::class,[
        'type'=>DatePicker::TYPE_INPUT,
        'options'=>[
            'placeholder'=>'Tanggal Transaksi'
        ],
        'pluginOptions' => [
            'orientation' => 'bottom',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>
    </div>

    <div class="col-lg-2">      
    <?= $form->field($model, 'status_trx')->label(false)->dropDownList(Ref::getTrx(),[
        'prompt'=>'Status Trans'
    ]) ?>
    </div>

   



    <div class="col-lg-12">
        <?= Html::submitButton('<i class="fa fa-search"></i> '.Yii::t('app', 'Cari'), ['class' => 'btn btn-primary']) ?>
       
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
<?php Panel::end();?>