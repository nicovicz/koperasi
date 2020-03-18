<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DtPinjaman */

$this->title = Yii::t('app', 'Create Dt Pinjaman');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dt Pinjamen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dt-pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
