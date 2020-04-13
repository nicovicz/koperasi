<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstUnit */


$this->title = 'Tambah Unit';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="mst-unit-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
