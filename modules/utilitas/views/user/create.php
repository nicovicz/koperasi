<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\User */

$this->title = 'Tambah Akun';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['create']];
?>
<div class="user-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
