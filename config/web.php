<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$log = require __DIR__ . '/log.php';
$config = [
    'id' => 'basic',
    'name'=>'Koperasi Hubla',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploadAnggota'   => '@app/storages/anggota',
    ],
    'language'=>'id',
    'timeZone'=>'Asia/Jakarta',
    'as access' => [
        'class' => '\hscstudio\mimin\components\AccessControl',
        'allowActions' => [
           '*'
       ],
    ],
    'container'=>[
        'definitions'=>[
            'yii\grid\SerialColumn'=>[
                'header'=>'No.',
                'contentOptions'=>['class'=>'text-center']
            ],
            'yii\grid\ActionColumn'=>[
                'header'=>'Aksi',
                'headerOptions'=>['class'=>'text-center'],
                'contentOptions'=>['class'=>'text-center']
            ],
            'yii\data\Pagination'=>[
                'pageSize'=>10
            ],
            'yii\grid\GridView'=>[
                'layout'=>"<div class='panel panel-blur light-text with-scroll animated zoomIn'>
                    <div class='panel-body'>
                      {items}
                      <div class='pull-right'>{pager}</div>
                      <div class='clearfix'></div>
                    </div>
                 </div>"
            ],
           

        ]
    ],
    'modules'=>[
        'master'=>[
            'class'=>'app\modules\master\Module'
        ],
        'anggota'=>[
            'class'=>'app\modules\anggota\Module'
        ],
        'simpanan'=>[
            'class'=>'app\modules\simpanan\Module'
        ],
        'pinjaman'=>[
            'class'=>'app\modules\pinjaman\Module'
        ],
        'angsuran'=>[
            'class'=>'app\modules\angsuran\Module'
        ],
        'utilitas' => [
            'class' => 'app\modules\utilitas\Module',
        ],
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'php:d F Y',
            'datetimeFormat' => 'php:d F Y H:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'IDR',
       ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'No5H03Mz9hWC4dhimjVRbclvpCJF0MUD',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.gmail.com',
                'username'=>'nicosusanto0893@gmail.com',
                'password'=>'@9l0b4LLL',
                'port' => '587' ,
                'encryption' => 'tls' ,
            ],
            'useFileTransport' => true,
        ],
        'log' => $log,
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
