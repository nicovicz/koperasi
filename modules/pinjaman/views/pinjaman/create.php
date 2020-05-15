<?php

use yii\helpers\Html;
use app\helpers\Ref;
/* @var $this yii\web\View */
/* @var $model app\models\DtPinjaman */

$this->title = Yii::t('app', 'Create Dt Pinjaman');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dt Pinjamen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dt-pinjaman-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
