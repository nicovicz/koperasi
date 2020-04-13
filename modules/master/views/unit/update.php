<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstUnit */

$this->title = 'Ubah Unit: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="mst-unit-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
