<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */

$this->title = 'Detil Anggota: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Anggota'
]);?>

<div class="col-lg-12">
<div class="media">
              <div class="media-left">
                <img src="<?=$model->getAvatar();?>" class="media-objectm img-circle" alt="Foto" style="width:200px;height:200px;margin-bottom:3%" />
                <p class="text-center"><?=$model->getStatusAnggota();?></p>
                <p class="text-center"><?=$model->getKetBergabung();?></p>
                </div>
                <div class="media-body">
                    <div class="col-lg-6">
                        <fieldset>
                            <legend style="color:#fff;padding:1%"><i class="fa fa-user"></i> Data Pribadi</legend>
                            <div class="list-group">
                           
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-flag"></i> <?=$model->getAttributeLabel('nip');?></h5>
                                <p class="list-group-item-text"><?=$model->nip;?></p>
                            </div>
                            <div class="list-group">
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-male"></i> <?=$model->getAttributeLabel('nama');?></h5>
                                <p class="list-group-item-text"><?=$model->nama;?></p>
                            </div>

                            <div class="list-group">
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-venus"></i> <?=$model->getAttributeLabel('jk');?></h5>
                                <p class="list-group-item-text"><?=$model->getGenderTranslate();?></p>
                            </div>

                            <div class="list-group">
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-phone"></i> <?=$model->getAttributeLabel('telp');?></h5>
                                <p class="list-group-item-text"><?=$model->telp;?></p>
                            </div>

                            <div class="list-group">
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-envelope"></i> <?=$model->getAttributeLabel('email');?></h5>
                                <p class="list-group-item-text"><?=$model->email;?></p>
                            </div>

                            <div class="list-group">
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-book"></i> <?=$model->getAttributeLabel('alamat');?></h5>
                                <p class="list-group-item-text"><?=$model->alamat;?></p>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset>
                            <legend style="color:#fff;padding:1%"><i class="fa fa-user"></i> Data Pekerjaan</legend>
                        

                            <div class="list-group">
                           
                           <h5 class="list-group-item-heading text-bold"><i class="fa fa-building"></i> <?=$model->getAttributeLabel('golongan');?></h5>
                           <p class="list-group-item-text"><?=$model->golongan;?></p>
                       </div>

                            <div class="list-group">
                           
                                <h5 class="list-group-item-heading text-bold"><i class="fa fa-building"></i> <?=$model->getAttributeLabel('jabatan');?></h5>
                                <p class="list-group-item-text"><?=$model->jabatan;?></p>
                            </div>

                            <div class="list-group">
                           
                           <h5 class="list-group-item-heading text-bold"><i class="fa fa-building"></i> <?=$model->getAttributeLabel('sub_bagian');?></h5>
                           <p class="list-group-item-text"><?=$model->sub_bagian;?></p>
                            </div>

                            <div class="list-group">
                           
                           <h5 class="list-group-item-heading text-bold"><i class="fa fa-building"></i> <?=$model->getAttributeLabel('bagian');?></h5>
                           <p class="list-group-item-text"><?=$model->bagian;?></p>
                            </div>

                            <div class="list-group">
                           
                           <h5 class="list-group-item-heading text-bold"><i class="fa fa-building"></i> <?=$model->getAttributeLabel('mst_unit_id');?></h5>
                           <p class="list-group-item-text"><?=$model->mstUnit->nama;?></p>
                            </div>
                            
                        </div>
                        </fieldset>
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
