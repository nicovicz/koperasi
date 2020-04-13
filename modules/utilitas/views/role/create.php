<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\AuthItem */

$this->title = 'Tambah Hak Akses';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Hak Akses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];

?>
<div class="auth-item-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
