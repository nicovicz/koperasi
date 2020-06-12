<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstMenu */

$this->title = 'Tambah Menu';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="mst-menu-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
