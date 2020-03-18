<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MstAnggota */

$this->title = Yii::t('app', 'Create Mst Anggota');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mst Anggotas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
