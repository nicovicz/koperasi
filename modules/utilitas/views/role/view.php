<?php
use app\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\models\Route;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model hscstudio\mimin\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">


<?php Panel::begin([
    'icon'=>'tags',
    'title'=>'Detil Hak Akses'
]);?>


<?=$this->render('@app/widgets/view-button',[
    'id'=>$model->name,
    'confirm'=>'Apakah Anda Yakin Akan Menghapus Hak Akses Ini?'
]);?>

                    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            //'type',
            //'description:ntext',
            //'rule_name',
            //'data:ntext',
            [
              'attribute' => 'created_at',
              'format' => ['date','php:d M Y H:i:s'],
            ],
            [
              'attribute' => 'updated_at',
              'format' => ['date','php:d M Y H:i:s'],
            ],
        ],
    ]) ?>
    <hr/>
    <?php
   
   $types = Route::find()->select('type')->distinct()->where(['status' => 1])->all();
    echo "<table id='permissionTable' class='table table-condensed table-striped table-hover table-bordered'>";
    echo "<tr>";
      echo "<th>Type</th>";
      echo "<th>Permision</th>";
    echo "<tr>";
    $auth = Yii::$app->authManager;
    $permissions = $auth->getPermissionsByRole($model->name);	
   
    foreach ($types as $type) {
      echo "<tr>";
      echo "<th>".$type->type."</th>";
      echo "<td>";
      $aliass = Route::find()->where([
        'status' => 1,
        'type' => $type->type,
      ])->all();
      foreach ($aliass as $alias) {
        echo "<label class='label-block'>";
		$can = array_key_exists($alias->name,$permissions);
		$checked = false;
		if($can) $checked = true;
		echo Html::checkbox($type->type.'_'.$alias->alias,$checked,[
		  'title' => $alias->name,
		  'class' => 'checkboxPermission',
		]).' '.$alias->alias;
		echo "</label>";
      }
      echo "</td>";
      echo "</tr>";
    }
    //echo "</tbody>";
    echo "</table>";
    ?>

<?php Panel::end();?>
</div>

<?php
$this->registerJs('
  $(".checkboxPermission").bind("click", function(){
      setPermission($(this).attr("title"));
  });

  function setPermission(permissionName){
    $.post( "'.Url::to(['permission','roleName'=>$model->name]).'&permissionName="+permissionName, function( data ) {
        console.log(data.data)
    });
  }
');

$this->registerCss('
    .label-block{
        display:block;
        width:100px;
        float:left;
        overflow:hidden;
        font-weight: normal;
        font-size:80%;
        border-right:1px solid #ddd;
        margin-right:5px;
    }

    table#permissionTable tbody tr td, table#permissionTable tbody tr th{
        padding: 0px 5px !important;
    }
');