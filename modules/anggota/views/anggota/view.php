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
<div class="route-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Anggota'
]);?>


<?=$this->render('@app/widgets/view-button',[
    'id'=>$model->id,
    'confirm'=>'Apakah Anda Yakin Akan Menghapus Anggota Ini?'
]);?>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nip',
            'nama',
            'jk',
            'jabatan',
            'golongan',
            'bagian',
            'sub_bagian',
            'foto',
            'telp',
            'email:email',
            'alamat:ntext',
            'mst_status_id',
            'mst_unit_id',
            'created_at',
          
            'updated_at',
           
        ],
    ]) ?>
<?php Panel::end();?>
</div>
