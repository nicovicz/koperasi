<?php

use yii\helpers\Html;
use app\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
$parentMenu = ArrayHelper::map(\app\models\MstMenu::find()->where('parent is null')->all(),'id','name');
$routes = ArrayHelper::map(hscstudio\mimin\models\Route::find()
    ->where(['status'=>'1'])
    ->andWhere('alias <> "*"')->all(),'name','name');
/* @var $this yii\web\View */
/* @var $model app\models\MstMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mst-menu-form">

    <?php $form = ActiveForm::begin([
        'model'=>$model
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->widget(Select2::class,[
         'theme' => Select2::THEME_BOOTSTRAP,
        'data'=>$parentMenu,
        'options'=>[
            'placeholder'=>'Pilih Parent Menu'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]); ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'route')->widget(Select2::class,[
         'theme' => Select2::THEME_BOOTSTRAP,
        'data'=>$routes,
        'options'=>[
            'placeholder'=>'Pilih Route'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

   

    

    <?php ActiveForm::end(); ?>

</div>
