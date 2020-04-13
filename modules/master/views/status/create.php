<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstStatus */

$this->title = Yii::t('app', 'Tambah Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manajemen Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-status-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
