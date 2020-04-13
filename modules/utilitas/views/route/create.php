<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = 'Tambah Izin';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="route-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
