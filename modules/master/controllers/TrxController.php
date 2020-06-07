<?php

namespace app\modules\master\controllers;

use yii\web\Controller;

class TrxController extends Controller
{
    use \app\helpers\CrudTrait;

    protected $modelClass = '\app\models\MstTrx';
    protected $modelSearchClass = '\app\models\MstTrxSearch';

    protected static $messages=[
        'SUCCESS_SAVE'=>'Data Status Transaksi Berhasil Disimpan',
        'FAIL_SAVE'=>'Data Status Transaksi Gagal Disimpan',
        'SUCCESS_UPDATE'=>'Data Status Transaksi Berhasil Diubah',
        'FAIL_UPDATE'=>'Data Status Transaksi Gagal Diubah',
        'SUCCESS_DELETE'=>'Data Status Transaksi Berhasil Dihapus',
        'FAIL_DELETE'=>'Data Status Transaksi Gagal Dihapus'
    ];
}
