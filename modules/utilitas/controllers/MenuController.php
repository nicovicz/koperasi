<?php

namespace app\modules\utilitas\controllers;

use Yii;
use app\models\MstMenu;
use app\models\MstMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * MenuController implements the CRUD actions for MstMenu model.
 */
class MenuController extends Controller
{
    use \app\helpers\CrudTrait;

    protected $modelClass = '\app\models\MstMenu';
    protected $modelSearchClass = '\app\models\MstMenuSearch';

    protected static $messages=[
        'SUCCESS_SAVE'=>'Data Menu Berhasil Disimpan',
        'FAIL_SAVE'=>'Data Menu Gagal Disimpan',
        'SUCCESS_UPDATE'=>'Data Menu Berhasil Diubah',
        'FAIL_UPDATE'=>'Data Menu Gagal Diubah',
        'SUCCESS_DELETE'=>'Data Menu Berhasil Dihapus',
        'FAIL_DELETE'=>'Data Menu Gagal Dihapus'
    ];
}
