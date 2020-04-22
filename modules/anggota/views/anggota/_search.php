<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Panel;
use app\helpers\Ref;
/* @var $this yii\web\View */
/* @var $model app\models\MstAnggotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Panel::begin([
    'title'=>'Pencarian Data Anggota',
    'icon'=>'fa fa-filter'
]);?>
<div class="mst-anggota-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    
    <div class="col-lg-2">
    <?= $form->field($model, 'nip')->label(false)->textInput([
        'placeholder'=>'NIP Pegawai'
    ]); ?>
    </div>
    <div class="col-lg-3">   
    <?= $form->field($model, 'nama')->label(false)->textInput([
        'placeholder'=>'Nama Pegawai'
    ]);?>
    </div>
  
    <div class="col-lg-2">      
    <?= $form->field($model, 'jabatan')->label(false)->textInput([
        'placeholder'=>'Jabatan Pegawai'
    ]); ?>
    </div>

    <div class="col-lg-3">      
    <?= $form->field($model, 'sub_bagian')->label(false)->textInput([
        'placeholder'=>'Unit Kerja'
    ]); ?>
    </div>

    <div class="col-lg-2">  
    <?php echo $form->field($model, 'mst_status_id')->label(false)->dropDownList(Ref::getStatus(),[
        'prompt'=>'Status Anggota'
    ]) ?>
    </div>

   

    

    <div class="col-lg-12">
        <?= Html::submitButton('<i class="fa fa-search"></i> '.Yii::t('app', 'Cari'), ['class' => 'btn btn-primary']) ?>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php Panel::end();?>