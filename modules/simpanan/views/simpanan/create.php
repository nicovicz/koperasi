<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DtSimpanan */

$this->title = Yii::t('app', 'Create Dt Simpanan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dt Simpanans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dt-simpanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
