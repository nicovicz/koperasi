<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\AuthItem */

$this->title = 'Ubah Hak Akses: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Hak Akses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->name]];
?>
<div class="auth-item-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
