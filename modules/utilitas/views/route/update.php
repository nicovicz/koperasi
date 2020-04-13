<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = 'Ubah Izin: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->name]];
?>
<div class="route-update">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
