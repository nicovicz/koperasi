<?php
use app\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = 'Detil Izin: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Permission'
]);?>


<?=$this->render('@app/widgets/view-button',[
    'id'=>$model->name,
    'confirm'=>'Apakah Anda Yakin Akan Menghapus Izin Ini?'
]);?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'alias',
            'type',
            'status',
        ],
    ]) ?>

<?php Panel::end();?>

</div>
