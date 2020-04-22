<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="blur-theme">
<?php $this->beginBody() ?>

<main>
        
        
        
<aside class="al-sidebar">
  
  <ul class="al-sidebar-list">
  <?php 
  $auth = Yii::$app->authManager;
  $roles = $auth->getRolesByUser(Yii::$app->user->id);
  $listRoles = (\yii\helpers\ArrayHelper::getColumn($roles,'name'));
  $m = \app\models\MstMenu::find()
  ->innerJoin('auth_item_child','mst_menu.route = auth_item_child.child')
  ->where(['IN','auth_item_child.parent',$listRoles])->asArray()->all();

  $parent = \app\models\MstMenu::find()
  ->where(['IN','id',array_unique(\yii\helpers\ArrayHelper::getColumn($m,function($item){
     $item['parent'] = empty($item['parent'])?$item['id']:$item['parent'];
    return $item['parent'];
  }))])->orderBy('order')->asArray()->all();
  $child = \yii\helpers\ArrayHelper::index($m,null,'parent');
 
 $current= Yii::$app->controller->uniqueId.'/'.Yii::$app->controller->action->id;
 $expand = false;
  ?>
  <?php foreach($parent as $p):?>

    <?php if (array_key_exists($p['id'],$child)):?>
      <li class="al-sidebar-list-item with-sub-menu ">
        <a class="al-sidebar-list-link" href="<?=$p['route']?>">
          <i class="<?=$p['icon'];?>"></i>
          <span><?=$p['name'];?></span>
          <b class="fa fa-angle-down"></b>
        </a>
        <ul class="al-sidebar-sublist">
          <?php foreach($child[$p['id']] as $c):?>
            <li class="ba-sidebar-sublist-item">
              <a href="<?=Url::to([$c['route']]);?>"><i class="<?=$c['icon'];?>"></i> 
              <?=$c['name'];?></a>
            </li>
          <?php endforeach;?>
        </ul>
      </li>
    <?php else:?>
      <li class="al-sidebar-list-item">
        <a class="al-sidebar-list-link" href="<?=$p['route']?>">
          <i class="<?=$p['icon'];?>"></i>
          <span><?=$p['name'];?></span>
        </a>
      </li>
    <?php endif;?>

  <?php endforeach;?>
    

   
   
    
  </ul>

</aside>

<div class="page-top clearfix">
    <a href="#/dashboard" class="al-logo clearfix"><span>Koperasi</a> 
    <a href="#" class="collapse-menu-link ion-navicon"></a>
    <div class="user-profile clearfix"><div class="al-user-profile dropdown" uib-dropdown=""><a class="profile-toggle-link dropdown-toggle" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-3x"></i></a><ul class="top-dropdown-menu profile-dropdown dropdown-menu" uib-dropdown-menu=""><li><i class="dropdown-arr"></i></li><li><a href="#/profile"><i class="fa fa-user"></i>Profile</a></li><li><a href=""><i class="fa fa-cog"></i>Settings</a></li><li><a href="" class="signout"><i class="fa fa-power-off"></i>Sign out</a></li></ul></div></div>
</div>

<div class="al-main">
  <div class="al-content">
  <div class="content-top clearfix">
  <?=Alert::widget();?>
  <?php echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);?>
  </div>
  <?=$content;?>
</div>
</div>

</main>

<?php
$this->registerJs("
$(document).on('click','.collapse-menu-link',function(e){
  e.preventDefault();
  var main = $('main');
  if (main.hasClass('menu-collapsed')){
    main.removeClass('menu-collapsed');
  }else{
    main.addClass('menu-collapsed');
   
  }
});

$(document).on('click','.profile-toggle-link',function(e){
  e.preventDefault();
  var main = $('.al-user-profile');
  if (main.hasClass('open')){
    main.removeClass('open');
  }else{
    main.addClass('open');
  
  }
});

$(document).on('click','.al-sidebar-list-item',function(e){
  
  var main = $(this);
  if (main.hasClass('ba-sidebar-item-expanded')){
    main.removeClass('ba-sidebar-item-expanded');
  }else{
    main.addClass('ba-sidebar-item-expanded');
  }
});

yii.confirm =  function (message, ok, cancel) {
  var that = $(this);
    Swal.fire({
     title : false,
     icon: 'warning',
     text : message,
     showCancelButton: true
    
    }).then(function(result) {
        if (result.value) {
          
          !ok || ok();		
        }else{

          !cancel || cancel();
              
        }

        
        
    });
    return false;

};


");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
