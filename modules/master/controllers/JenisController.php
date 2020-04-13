<?php

namespace app\modules\master\controllers;

use yii\web\Controller;

class JenisController extends Controller
{
    use \app\helpers\CrudTrait;

    protected $modelClass = '\app\models\MstJenis';
    protected $modelSearchClass = '\app\models\MstJenisSearch';

    protected static $messages=[
        'SUCCESS_SAVE'=>'Data Jenis Simpanan Berhasil Disimpan',
        'FAIL_SAVE'=>'Data Jenis Simpanan Gagal Disimpan',
        'SUCCESS_UPDATE'=>'Data Jenis Simpanan Berhasil Diubah',
        'FAIL_UPDATE'=>'Data Jenis Simpanan Gagal Diubah',
        'SUCCESS_DELETE'=>'Data Jenis Simpanan Berhasil Dihapus',
        'FAIL_DELETE'=>'Data Jenis Simpanan Gagal Dihapus'
    ];
}
