<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MstAnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manajemen Anggota Koperasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-anggota-index">

    

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nip',
            'nama',
            'bagian',
            'sub_bagian',
            'telp',
           
            [
                'label'=>'Status Anggota',
                'attribute'=>'mstStatus.nama'
            ],
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    

</div>
