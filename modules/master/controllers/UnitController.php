<?php

namespace app\modules\master\controllers;

use yii\web\Controller;

class UnitController extends Controller
{
    use \app\helpers\CrudTrait;

    protected static $messages=[
        'SUCCESS_SAVE'=>'Data Unit Berhasil Disimpan',
        'FAIL_SAVE'=>'Data Unit Gagal Disimpan',
        'SUCCESS_UPDATE'=>'Data Unit Berhasil Diubah',
        'FAIL_UPDATE'=>'Data Unit Gagal Diubah',
        'SUCCESS_DELETE'=>'Data Unit Berhasil Dihapus',
        'FAIL_DELETE'=>'Data Unit Gagal Dihapus'
    ];
}
