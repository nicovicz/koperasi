<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DtSimpanan */

$this->title = 'Tambah Simpanan Wajib';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Simpanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="dt-simpanan-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
