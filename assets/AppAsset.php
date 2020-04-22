<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      
        'css/vendor-2cae343ef1.css',
        'css/app-b6796b3788.css',
        'css/jquery.growl.css',
        'css/site.css',
        
       
       
    ];
    public $js = [
        'js/bootstrap-select.js',
        'js/dropdown.js',
        'js/jquery.easing.js',
        'js/jquery.slimscroll.js',
        'js/jstree.js',
        'js/animate.js',
        'js/sweetalert2@9.js',
        'js/jquery.growl.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
