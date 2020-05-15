<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\Ref;
use app\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */
/* @var $form yii\widgets\ActiveForm */
$attr = ['maxlength'=>true];
if (!$model->isNewRecord){
    $attr = ['maxlength'=>true,'readonly'=>'readonly'];
}
?>

<div class="mst-anggota-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-6">
        <?= $form->field($model, 'nip',[
            'template' => "{label}<div class=\"col-lg-9\"><div class=\"input-group\">{input}<span class=\"input-group-btn\"><button id=\"cari\" class=\"btn btn-success\">Cari</button></span>{error}
            </div></div>",
        ])->textInput($attr) ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jk')->radioList(['L'=>'Laki-Laki','P'=>'Perempuan']) ?>

        <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto')->fileInput() ?>

        <?=Html::activeHiddenInput($model,'fotoTemp');?>
        <div class="form-group">
            <div  class="col-lg-3"></div>
            <div id="foto" class="col-lg-9 pull-3"></div>
           
            
        </div>

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
$nip = '#'.Html::getInputId($model,'nip');
$jk = Html::getInputName($model,'jk');
$golongan = '#'.Html::getInputId($model,'golongan');
$nama = '#'.Html::getInputId($model,'nama');
$email = '#'.Html::getInputId($model,'email');
$jabatan = '#'.Html::getInputId($model,'jabatan');
$bagian = '#'.Html::getInputId($model,'bagian');
$sub_bagian  = '#'.Html::getInputId($model,'sub_bagian');
$foto  = '#'.Html::getInputId($model,'fotoTemp');
$telp  = '#'.Html::getInputId($model,'telp');
$unit  = '#'.Html::getInputId($model,'mst_unit_id');
$this->registerJs("

$(document).on('click','#cari',function(e){
    e.preventDefault();
    var nip = $('".$nip."').val();
    $.post('".$url."',{nip:nip},function(res){
        $('".$foto."').val(res.foto);
        $('".$telp."').val(res.telepon);
        $('".$nama."').val(res.nama);
        $('".$email."').val(res.email);
        $('".$golongan."').val(res.golongan + ' ' +res.pangkat);
        if (res.jabatan_struktural !== ''){
            $('".$jabatan."').val(res.jabatan_struktural);
        }else{
            $('".$jabatan."').val(res.jabatan_fungsional);
        }
        $('".$sub_bagian."').val(res.subkantor);
        $('".$bagian."').val(res.kantor);
        $('".$unit." option:contains(\"Kementerian\")').attr('selected', 'selected');
       
        $('input[name=\"".$jk."\"][value=\"'+res.jenis_kelamin+'\"]').attr(\"checked\",true);
        $('#foto').append('<img src=\"'+res.foto+'\" style=\"width:100px;height:100px\" />');
    });
});

");