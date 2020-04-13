<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    use \app\helpers\AuthGuardTrait;

    public function actionPegawai()
    {
        $nip = Yii::$app->request->post('nip');
        $client = new \mongosoft\soapclient\Client([
            'url' => 'http://sik.dephub.go.id/api/index.php/soap_services/sik_api?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'trace' => 1,
                'login'=>'getdatasik',
                'password'=>'123456',
                'exception' => 1,
                'connection_timeout' => 15,
            ]
        ]);


        $req = $client->__call('get_pegawai_by_nip',
                [
                    'nip'=>$nip
                ]);

       
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $req['return'][0];
    }
}