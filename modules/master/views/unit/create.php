<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstUnit */

$this->title = Yii::t('app', 'Create Mst Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mst Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
