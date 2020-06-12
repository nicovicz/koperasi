<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MstJenisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manajemen Jenis Simpanan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-jenis-index">

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'nama',
            'created_at:datetime',
            'updated_at:datetime',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
