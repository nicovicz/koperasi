<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstTrx */

$this->title = Yii::t('app', 'Create Mst Trx');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mst Trxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-trx-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
