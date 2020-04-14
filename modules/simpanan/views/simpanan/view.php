<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DtSimpanan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dt Simpanans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dt-simpanan-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'jumlah',
            'tgl_trx',
            'status_trx',
            'mst_jenis_id',
            'mst_anggota_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
