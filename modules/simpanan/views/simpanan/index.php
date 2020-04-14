<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DtSimpananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manajemen Simpanan Koperasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dt-simpanan-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'mst_anggota_id',
            'mst_jenis_id',
            'jumlah',
            'tgl_trx',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
