<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\widgets\Panel;
use app\helpers\Ref;
/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */
$anggota = $model->mstAnggota;
$jenis = $model->mstJenis;
$this->title = 'Detil '.$jenis->nama.' : '.$anggota->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Pinjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pinjaman = Ref::HitungPerBulan($model);
?>
<div class="simpanan-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Pinjaman'
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
                            <legend style="color:#fff;padding:1%"><i class="fa fa-briefcase"></i> Data Transaksi Pinjaman </legend>
                        
                            <div class="list-group">
                               
                               <p class="list-group-item-text text-center"><?=Ref::pinjamanTranslate($model->status_pinjaman);?></p>
                           </div>
                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('tgl_trx');?> :</strong>  <?=Yii::$app->formatter->asDate($model->tgl_trx);?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('jumlah');?> :</strong>  <?=Yii::$app->formatter->asCurrency($model->jumlah);?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <em>Terbilang :</strong>  <?=ucwords(terbilang(number_format($model->jumlah,0,'','')));?> Rupiah</em></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('tenor');?> :</strong> <?=$model->tenor;?> Bulan</p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <?=$model->getAttributeLabel('bunga');?> :</strong> <?=$model->bunga;?> %</p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i> Perbulan :</strong> <?=Yii::$app->formatter->asCurrency($pinjaman['pokok']);?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i> Bunga Per Bulan :</strong> <?=Yii::$app->formatter->asCurrency($pinjaman['bunga']);?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i> Terbayar :</strong>  <?=$model->jumlahAngsuranLunas;?> / <?=$model->tenor;?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i> Total :</strong>  <?=Yii::$app->formatter->asCurrency(
                                  $total=  ($pinjaman['pokok']*$model->tenor)+($pinjaman['bunga']*$model->tenor)
                                );?></p>
                           </div>

                           <div class="list-group" style="margin-top:-3%">
                               
                               <p class="list-group-item-text"><strong><i class="fa fa-check-square" style="color:#90b900"></i>  <em>Terbilang :</strong>  <?=ucwords(terbilang(number_format($total,0,'','')));?> Rupiah</em></p>
                           </div>

                           

                          
                           

                          
                           
                       
                        </fieldset>
                    </div>
                </div>

                   
            </div>
</div>
            <div class="col-lg-12">
    <hr/>

    
        <h5>Tabel Angsuran Cicilan</h5>

        <table class="table table-bordered cicilan-header">
            <thead>
                <tr>
                    <th class="text-center">No</th><th class="text-center">Cicilan Ke</th>
                    <th class="text-center">Pokok</th><th class="text-center">Bunga</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Tgl Jatuh Tempo</th>
                    <th class="text-center">Jml Dibayar</th>
                    
                    <th class="text-center">Tgl Bayar</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->dtAngsuransView as $index=> $angsuran):?>
                <?php
                    $model->tgl_trx =  strtotime('+1 month',strtotime($model->tgl_trx));
                ?>
                <tr>
                    <td class="text-center"><?=($index+1);?></td>
                    <td class="text-center"><?=$angsuran->angsuran_ke;?></td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency($angsuran->angsuran_pokok);?></td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency($angsuran->angsuran_bunga);?></td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency(($angsuran->angsuran_pokok+$angsuran->angsuran_bunga));?></td>
                    <td class="text-right"><?=Yii::$app->formatter->asDate($model->tgl_trx);?></td>
                    <td class="text-right"><?=Yii::$app->formatter->asCurrency($angsuran->jumlah);?></td>
                    <td class="text-right"><?=($angsuran->tgl_trx?Yii::$app->formatter->asDate($angsuran->tgl_trx):'-');?></td>
                    <td class="text-center"><?=Ref::trxTranslate($angsuran->status_trx);?></td>
                    <td class="text-center">
                        
                        <?php if ($angsuran->isBelumBayar()):?>
                            <a href="<?=Url::to(['/angsuran/angsuran/update','id'=>$angsuran->id]);?>" class="bayar"><i class="fa fa-pencil" style="color:#fff"></i></a>
                        <?php endif;?>
                        <?php if ($angsuran->isSudahBayar()):?>
                            <?=Html::a('<i class="fa fa-trash" style="color:#fff"></i>',Url::to(['/angsuran/angsuran/delete','id'=>$angsuran->id]),[
                                'data-confirm'=>'Apakah Yakin Membatalkan Pembayaran Ini?',
                                'data-method'=>'POST'
                            ]);?>
                           
                        <?php endif;?>
                    </td>
                </tr>
                <?php $model->tgl_trx = date('Y-m-d',$model->tgl_trx);?>
                <?php endforeach;?>
            </tbody>
        </table>
        <br/>
    
    <div class="pull-right">
    <?=$this->render('@app/widgets/back-button');?>
</div>
</div>

<?php Panel::end();?>
</div>
<div class="modal fade" id="modal-pembayaran" tabindex="-1" role="dialog" style="margin-top:10%">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: url(<?=Yii::getAlias('@web');?>/img/blur-bg-blurred.jpg) fixed">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color:#fff">Pembayaran Angsuran</h4><hr/>
      </div>
      <div class="modal-body">
        
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerJs("
    
    $(document).on('click','.bayar',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        yii.confirm('Yakin Akan Melakukan Pembayaran Angsuran?',function(){
            $('.modal-body').load(url,function(){
                $('#modal-pembayaran').modal('toggle');
                
            });
            
        });
            
        
    });

    $('#modal-pembayaran').on('hide.bs.modal',function (e) {
       window.location.reload();
    });
");?>

