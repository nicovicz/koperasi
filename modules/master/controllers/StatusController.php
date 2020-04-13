<?php

namespace app\modules\master\controllers;

use yii\web\Controller;

class StatusController extends Controller
{
    use \app\helpers\CrudTrait;

    protected static $messages=[
        'SUCCESS_SAVE'=>'Data Status Berhasil Disimpan',
        'FAIL_SAVE'=>'Data Status Gagal Disimpan',
        'SUCCESS_UPDATE'=>'Data Status Berhasil Diubah',
        'FAIL_UPDATE'=>'Data Status Gagal Diubah',
        'SUCCESS_DELETE'=>'Data Status Berhasil Dihapus',
        'FAIL_DELETE'=>'Data Status Gagal Dihapus'
    ];
}
