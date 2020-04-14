<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */

$this->title = 'Ubah Anggota: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Anggota Koperasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="mst-anggota-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
