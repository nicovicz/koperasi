<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model app\models\MstJenis */


$this->title = 'Detil Jenis Simpanan: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Jenis Simpanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-jenis-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Jenis Simpanan'
]);?>


<?=$this->render('@app/widgets/view-button',[
    'id'=>$model->id,
    'confirm'=>'Apakah Anda Yakin Akan Menghapus Item Ini?'
]);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'nama',
            'created_at:datetime',
          
            'updated_at:datetime',
           
        ],
    ]) ?>

<?php Panel::end();?>
</div>
