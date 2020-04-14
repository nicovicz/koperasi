<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */

$this->title = 'Tambah Anggota';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Anggota Koperasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="mst-anggota-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
