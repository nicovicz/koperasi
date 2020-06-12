<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstMenu */

$this->title = 'Ubah Menu: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->name]];
?>
<div class="mst-menu-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
