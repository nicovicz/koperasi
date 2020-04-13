<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\User */

$this->title = 'Ubah Akun: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="user-update">

	

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
