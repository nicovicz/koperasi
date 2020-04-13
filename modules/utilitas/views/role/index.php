<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Hak Akses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

	

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'caption'=>'<h3><i class="fa fa-folder-open"></i> '.$this->title.'</h3>',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'name',
			/*
			'type',
			'description:ntext',
			'rule_name',
			'data:ntext',
			// 'created_at',
			// 'updated_at',
			*/
			[
				'options' => [
					'width' => '80px',
				],
				'class' => 'yii\grid\ActionColumn'
			],
		],
	]); ?>

</div>
