<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\Ref;
use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mst-anggota-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-6">
        <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jk')->radioList(['L'=>'Laki-Laki','P'=>'Perempuan']) ?>

        <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto')->fileInput() ?>

        <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-lg-6">
        <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'golongan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'bagian')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sub_bagian')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mst_unit_id')->dropDownList(Ref::getUnit(),['prompt'=>'Pilih Unit']) ?>

        <?php if ($model->isNewRecord):?>

        <?= $form->field($model, 'mst_status_id')->radioList(Ref::getStatus()) ?>

       

        <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

        <?php endif;?>
    </div>
   
    
    <?php ActiveForm::end(); ?>

</div>
<?php
$url = Url::to(['/api/pegawai']);
$golongan = '#'.Html::getInputId($model,'golongan');
$nama = '#'.Html::getInputId($model,'nama');
$jabatan = '#'.Html::getInputId($model,'jabatan');
$bagian = '#'.Html::getInputId($model,'bagian');
$sub_bagian  = '#'.Html::getInputId($model,'sub_bagian');
$this->registerJs("

$(document).on('click','.cari',function(e){
    e.preventDefault();
    var nip = $(this).val();
    $.post('".$url."',{nip:nip},function(){

    });
});

");