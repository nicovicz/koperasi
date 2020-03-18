<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstStatus */

$this->title = Yii::t('app', 'Create Mst Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mst Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
