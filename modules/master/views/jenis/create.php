<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstJenis */

$this->title = Yii::t('app', 'Create Mst Jenis');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mst Jenis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
