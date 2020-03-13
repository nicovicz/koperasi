<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
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


        
        
        
        <aside class="al-sidebar">
  <ul class="al-sidebar-list">
    <li class="al-sidebar-list-item">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="al-sidebar-list-item with-sub-menu">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Dashboard</span>
        <b class="fa fa-angle-down"></b>
      </a>
      <ul class="ba-sidebar-sublist-item">
        <li>Mail</li>
      </ul>
    </li>
  </ul>
</aside>

<div class="page-top clearfix" scroll-position="scrolled" max-height="50" >
    <a href="#/dashboard" class="al-logo clearfix"><span>Blur</span>Admin</a> 
    <a href="#" class="collapse-menu-link ion-navicon"></a>
    
    <div class="user-profile clearfix">
      <div class="al-user-profile dropdown" uib-dropdown="" style="">
        <a  class="profile-toggle-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
          <img src="./img/app/profile/Nasta.png">
        </a>
        <ul class="top-dropdown-menu profile-dropdown dropdown-menu">
          <li><i class="dropdown-arr"></i></li>
          <li><a href="#/profile"><i class="fa fa-user"></i>Profile</a></li>
          <li><a href=""><i class="fa fa-cog"></i>Settings</a></li>
          <li role="separator" class="divider"></li>

          <li><a href="" class="signout"><i class="fa fa-power-off"></i>Sign out</a></li>
        </ul>
      </div>
</div>
<?php
$this->registerJs("
$(document).on('click','.collapse-menu-link',function(){
   animateCSS('.al-logo','fadeOut');
});
");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
