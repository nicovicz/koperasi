<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\Ref;
$activeStatus = Ref::getActiveStatus();
/* @var $this yii\web\View */
/* @var $searchModel app\models\MstAnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manajemen Anggota Koperasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-anggota-index">

    

   
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
                    return '<img class="img-circle" style="width:50px;height:50px;margin-top:20px" src="https://www.akveo.com/blur-admin/assets/img/app/profile/Kostya.png">';
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($model){
                    return sprintf('<div class="name-container">
                        <div>
                            <span>%s / %s</span>
                        </div>
                        <div>
                            <span>%s</span>
                        </div>
                        <div style="margin-top:-2.5%%">
                            <span>%s</span>
                        </div>
                    </div>',
                        $model->nip,
                        $model->nama,
                        $model->jabatan,
                        $model->mstUnit->nama);
                }
            ],
            [
                'format'=>'raw',
                'contentOptions'=>['style'=>'width:55px'],
                'value'=>function($model){
                    return $model->getStatusAnggota();
                }
            ],
            
           
           

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'delete'=>function($url, $model, $key) use ($activeStatus){
                        if ($model->mst_status_id == $activeStatus){
                            $icon = 'fa fa-times-circle';
                            $message = 'Apakah Anda Akan Menonaktifkan Anggota Ini?';
                        }else{
                            $icon = 'fa fa-check-circle';
                            $message = 'Apakah Anda Akan Mengaktifkan Anggota Ini?';
                        }
                        return Html::a('<span class="'.$icon.'"></span>',$url,[
                            'title'=>Yii::t('app','Delete'),
                            'aria-label'=>Yii::t('app','Delete'),
                            'data-confirm'=>$message
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    

</div>
