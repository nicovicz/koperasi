<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstJenis */

$this->title = 'Ubah Jenis Simpanan: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Jenis Simpanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="mst-jenis-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
