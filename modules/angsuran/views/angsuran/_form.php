<?php

use yii\helpers\Html;
use app\helpers\Ref;
use app\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\DtAngsuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dt-angsuran-form">
    <?php if ($model->status_trx == Ref::getInit()):?>
        <?php if ($message):?>
            <div class="alert alert-<?=$message['status'];?>">
                <p class="text-<?=$message['status'];?>"><?=$message['message'];?></p>
            </div>
        <?php endif;?>
        <?php Pjax::begin([
            'enablePushState'=>false
        ]);?>
        
        <?php $form = ActiveForm::begin([
            'id'=>'form-angsuran',
            'options'=>[
                'data-pjax'=>true,
                'class'=>'form-horizontal'
            ]
        ]); ?>
        
        <?= $form->field($model, 'tgl_trx')->widget(DatePicker::class,[
            'pluginOptions' => [
                'orientation' => 'bottom',
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose' => true
            ],
            'options'=>[
                'style'=>'color:#fff'
            ]
        ]) ?>

        <?= $form->field($model, 'jumlah')->textInput(['style'=>'color:#fff']) ?>
    


        <?php ActiveForm::end(); ?>
        <?php Pjax::end();?> 
    <?php else:?>
        <?php if ($message):?>
            <div class="alert alert-<?=$message['status'];?>">
                <p class="text-<?=$message['status'];?>"><?=$message['message'];?></p>
            </div>
        <?php endif;?>
    <?php endif;?>      
</div>

<?php
$this->registerJs("
$(document).on('pjax:complete',function(event, data, status, xhr, options) {
    
    
});
");