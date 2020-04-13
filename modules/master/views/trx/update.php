<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstTrx */

$this->title = 'Ubah Status Transaksi: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Status Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="mst-trx-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
