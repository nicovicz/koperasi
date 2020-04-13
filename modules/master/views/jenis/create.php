<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstJenis */

$this->title = Yii::t('app', 'Tambah Jenis Simpanan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manajemen Jenis Simpanan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-jenis-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
