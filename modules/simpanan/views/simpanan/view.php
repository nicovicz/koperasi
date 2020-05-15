<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Panel;
use app\helpers\Ref;
/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */
$anggota = $model->mstAnggota;
$jenis = $model->mstJenis;
$this->title = 'Detil '.$jenis->nama.' : '.$anggota->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Simpanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpanan-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Simpanan'
]);?>

<div class="col-lg-12">
<div class="media">
              <div class="media-left">
                <?=$this->render('@app/widgets/detil-avatar',['anggota'=>$anggota]);?>
                </div>
                <div class="media-body">
                    <div class="col-lg-6">
                        <fieldset>
                            <legend style="color:#fff;padding:1%"><i class="fa fa-user"></i> Data Anggota</legend>
                            <?=$this->render('@app/widgets/detil-anggota',['anggota'=>$anggota]);?>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset>
                            <legend style="color:#fff;padding:1%"><i class="fa fa-briefcase"></i> Data Transaksi <?=$jenis->nama;?> </legend>
                        
                            <div class="list-group">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i> <?=$model->getAttributeLabel('tgl_trx');?> :</strong>   <?=Yii::$app->formatter->asDate($model->tgl_trx);?></p>
                           </div>

                           <div class="list-group">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('jumlah');?> :</strong>  <?=Yii::$app->formatter->asCurrency($model->jumlah);?></p>
                           </div>

                           <div class="list-group">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <em>Terbilang :</strong>  <?=ucwords(terbilang(number_format($model->jumlah,0,'','')));?> Rupiah</em></p>
                           </div>

                           <div class="list-group">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('status_trx');?> :</strong>  <?=Ref::trxTranslate($model->status_trx);?></p>
                           </div>

                          
                           
                       
                        </fieldset>
                    </div>
                </div>

                   
            </div>
</div>
            <div class="col-lg-12">
    <hr/>
    <div class="pull-right">
    <?=$this->render('@app/widgets/back-button');?>
</div>
</div>

<?php Panel::end();?>
</div>
