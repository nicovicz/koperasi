<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model app\models\MstMenu */

$this->title = 'Detil Menu: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-menu-view">

<?php Panel::begin([
    'icon'=>'info-circle',
    'title'=>'Detil Menu'
]);?>


<?=$this->render('@app/widgets/view-button',[
    'id'=>$model->id,
    'confirm'=>'Apakah Anda Yakin Akan Menghapus Menu Ini?'
]);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'name',
            'parent',
            'order',
            'icon',
            'route',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>
<?php Panel::end();?>
</div>
