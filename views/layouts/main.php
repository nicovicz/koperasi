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

<main>
        
        
        
<aside class="al-sidebar">
  
  <ul class="al-sidebar-list">
 
    <li class="al-sidebar-list-item">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="al-sidebar-list-item with-sub-menu ">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Transaksi</span>
        <b class="fa fa-angle-down"></b>
      </a>
      <ul class="al-sidebar-sublist">
        <li class="ba-sidebar-sublist-item">
          <a>Tambah Anggota</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Daftar Anggota</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Tambah Simpanan</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Daftar Simpanan</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Tambah Pinjaman</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Daftar Pinjaman</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Tambah Angsuran</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Daftar Angsuran</a>
        </li>
      </ul>
    </li>

    <li class="al-sidebar-list-item with-sub-menu ">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Master</span>
        <b class="fa fa-angle-down"></b>
      </a>
      <ul class="al-sidebar-sublist">
        <li class="ba-sidebar-sublist-item">
          <a>Status Transaksi</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Status Anggota</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Jenis Pinjaman</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Unit</a>
        </li>
      </ul>
    </li>

    <li class="al-sidebar-list-item with-sub-menu ">
      <a class="al-sidebar-list-link">
        <i class="ion-android-home"></i>
        <span>Utilitas</span>
        <b class="fa fa-angle-down"></b>
      </a>
      <ul class="al-sidebar-sublist">
        <li class="ba-sidebar-sublist-item">
          <a>Role</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Status Anggota</a>
        </li>
        <li class="ba-sidebar-sublist-item">
          <a>Jenis Pinjaman</a>
        </li>

        <li class="ba-sidebar-sublist-item">
          <a>Unit</a>
        </li>
      </ul>
    </li>
   
    
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
   
  <ul class="breadcrumb al-breadcrumb"><li><a href="#/dashboard">Home</a></li><li class="ng-binding">Smart Tables</li></ul>
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
  e.preventDefault();
  var main = $(this);
  if (main.hasClass('ba-sidebar-item-expanded')){
    main.removeClass('ba-sidebar-item-expanded');
  }else{
    main.addClass('ba-sidebar-item-expanded');
  }
});


");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
