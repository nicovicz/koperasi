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

   
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions'=>[
            'class'=>'table'
        ],
        'showHeader'=>false,
        'filterModel' => null,
        'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'format'=>'raw',
                'contentOptions'=>['style'=>'width:55px'],
                'value'=>function($model){
                    return $model->mstAnggota->getDisplayAvatar();
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($model){
                    return $model->mstAnggota->getDisplayAnggota();
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($model){
                    return $model->getDisplaySimpanan();
                }
            ],
            [
                'contentOptions'=>['class'=>'text-right','style'=>'vertical-align:middle'],
                'attribute'=>'jumlah',
                'format'=>'currency'
            ],
           

            [
                'class' => 'yii\grid\ActionColumn','template'=>'{view} {delete}',
                'buttons'=>[
                    'delete'=>function($url, $model, $key){
                       
                       
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                            'title'=>Yii::t('app','Delete'),
                            'aria-label'=>Yii::t('app','Delete'),
                            'data-confirm'=>'Apakah Anda Yakin Akan Membatalkan Transaksi Simpanan ini?'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
