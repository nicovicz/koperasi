<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstTrx */

$this->title = Yii::t('app', 'Tambah Status Transaksi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manajemen Status Transaksi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-trx-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
