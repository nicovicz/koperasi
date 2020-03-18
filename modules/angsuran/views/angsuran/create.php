<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DtAngsuran */

$this->title = Yii::t('app', 'Create Dt Angsuran');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dt Angsurans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dt-angsuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
