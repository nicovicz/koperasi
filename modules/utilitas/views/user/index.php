<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Akun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'username',
			//'auth_key',
			//'password_hash',
			//'password_reset_token',
			'email:email',
			[
				'attribute' => 'roles',
				'format' => 'raw',
				'value' => function ($data) {
					$roles = [];
					foreach ($data->roles as $role) {
						$roles[] = $role->item_name;
					}
					return implode(', ', $roles);
				}
			],
			[
				'attribute' => 'status',
				'format' => 'raw',
				'options' => [
					'width' => '80px',
				],
				'value' => function ($data) {
					if ($data->status == 10)
						return "<span class='label label-primary'>" . 'Active' . "</span>";
					else
						return "<span class='label label-danger'>" . 'Banned' . "</span>";
				}
			],
			[
				'attribute' => 'created_at',
				'label'=>'Dibuat Pada',
				'format' => ['date', 'php:d M Y H:i'],
				'options' => [
					'width' => '120px',
				],
			],
			[
				'attribute' => 'updated_at',
				'label'=>'Diubah Pada',
				'format' => ['date', 'php:d M Y H:i'],
				'options' => [
					'width' => '120px',
				],
			],
			[
				'options' => [
					'width' => '80px',
				],
				'class' => 'yii\grid\ActionColumn'
			],
		],
	]); ?>

</div>
