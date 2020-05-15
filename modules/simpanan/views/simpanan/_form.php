<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\DtSimpanan */
/* @var $form yii\widgets\ActiveForm */

$formatJs = <<< JS
var format = function (data) {
   
    if (data.loading) {
        return 'Data Tidak Ditemukan';
    }else{  
        var markup = '';
    
        
            markup +=
            '<div class="media">' 
                + '<div class="media-left">' 
                + '<img src="'+data.avatar+'" class="media-objectm img-circle" style="width:50px;height:50px;" />'
                + '</div>'+
                '<div class="media-body"><h4> ' + data.text.nip + ' / ' + data.text.nama  +'</h4>' +
                '<h5> '+data.text.jabatan+ ' - '+ data.text.sub_bagian + '</h5>' +
                '<h5> '+data.text.bagian+'</h5>' +
                '</div>' +
            '</div>';
       
  
     return '<div style="overflow:hidden;">' + markup + '</div>';
    }
};
JS;
// Register the formatting script
$this->registerJs($formatJs, \yii\web\View::POS_HEAD);
$urlSimpanan = Url::to(['/api/simpanan']);
$dropDownSimpanan = '#'.Html::getInputId($model,'mst_jenis_id');
?>

<div class="dt-simpanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mst_anggota_id')->widget(Select2::class,[
        'theme' => Select2::THEME_BOOTSTRAP,
        'options'=>[
            'placeholder'=>'Pilih Anggota Koperasi'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => Url::to(['/api/anggota-formatted']),
            ],
            'templateSelection' => new JsExpression('function(data){
                                   
                return data.nama;
            }'),
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('format'),

        ],
        'pluginEvents'=>[
            "select2:select" => "function(e) { 

                var data = e.params.data;
               
                $.post('".$urlSimpanan."' ,{id:data.text.mst_unit_id},function(res){
                    var select = $('".$dropDownSimpanan."');
                    select.empty();
                    select.append($('<option></option>').val('').html('Pilih'));
                    $.each(res, function(val, text) {
                        
                        select.append(
                            $('<option></option>').val(text.id).html(text.nama)
                        );
                    });
                });
             }",
        ]

    ]) ?>

    <?= $form->field($model, 'tgl_trx')->widget(DatePicker::class,[
        'pluginOptions' => [
            'orientation' => 'bottom',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'mst_jenis_id')->dropDownList([]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    

   
    <?php ActiveForm::end(); ?>

</div>
