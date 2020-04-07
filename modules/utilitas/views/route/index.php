<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

	
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class='panel panel-blur light-text with-scroll animated zoomIn'>
	<div class='panel-body'>
	<p>
		<?= Html::a('<i class="fa fa-plus-circle"></i> Create Route', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('<i class="fa fa-magic"></i> Generate Route', ['generate'], ['class' => 'btn btn-primary']) ?>
	</p>
	</div></div>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'caption'=>'<h3><i class="fa fa-database"></i> Manajemen Route</h3>',
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'type',
			'alias',
			'name',
			[
				'attribute' => 'status',
				'filter' => [0 => 'off', 1 => 'on'],
				'format' => 'raw',
				'options' => [
					'width' => '80px',
				],
				'value' => function ($data) {
					if ($data->status == 1)
						return "<span class='label label-primary'>" . 'On' . "</span>";
					else
						return "<span class='label label-danger'>" . 'Off' . "</span>";
				}
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
