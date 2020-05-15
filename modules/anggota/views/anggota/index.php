<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\helpers\Ref;

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
                    return $model->getDisplayAvatar();
                }
            ],
            [
                'format'=>'raw',
                'value'=>function($model){
                    return $model->getDisplayAnggota();
                }
            ],
            [
                'format'=>'raw',
                'contentOptions'=>['style'=>'width:255px','class'=>'text-center'],
                'value'=>function($model){
                    return $model->getStatusAnggota().'<br/>'.$model->getKetBergabung();
                }
            ],
            
           
           

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'delete'=>function($url, $model, $key){
                        $status = ArrayHelper::getValue($model,'mstStatus.data');
                        $array_status = json_decode($status,true);

                        if ($array_status){
                            $icon = $array_status['icon_confirm'];
                            $tip =  $array_status['tooltip_anggota'];
                            $message = $array_status['message_confirm_anggota'];
                            return Html::a('<span class="'.$icon.'"></span>',$url,[
                                'title'=>Yii::t('app',$tip),
                                'aria-label'=>Yii::t('app',$tip),
                                'data-confirm'=>$message
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>

    

</div>
