<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MstMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manajemen Menu');
$this->params['breadcrumbs'][] = $this->title;
$parentMenu = ArrayHelper::map(\app\models\MstMenu::find()->where('parent is null')->all(),'id','name');
?>
<div class="mst-menu-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',  'contentOptions'=>['class'=>'text-center']],

         
            'name',
            ['attribute'=>'parent','value'=>'parentMenu.name','filter'=>$parentMenu],
            ['attribute'=>'order','contentOptions'=>['class'=>'text-center']],
            ['attribute'=>'icon','value'=>'labelIcon','format'=>'raw','contentOptions'=>['class'=>'text-center']],
            'route',
            'created_at:datetime',
            //'created_by',
            'updated_at:datetime',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
