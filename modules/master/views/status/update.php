<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstStatus */

$this->title = 'Ubah Status: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="mst-status-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
