<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model app\models\MstStatus */

$this->title = 'Detil Status: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mst-status-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Status'
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
