<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\MstAnggota;
use app\models\DtGroupSimpanan;
use app\helpers\Ref;

class ApiController extends Controller
{
    //use \app\helpers\AuthGuardTrait;

    public function actionPegawai()
    {
        $nip = Yii::$app->request->post('nip');
        $client = new \mongosoft\soapclient\Client([
            'url' => 'https://sik.dephub.go.id/api/index.php/soap_services/sik_api?wsdl',
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

    public function actionAnggota($q = null, $id = null)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        $model = MstAnggota::find()
            ->select(['id','nama text'])
            ->where(['mst_status_id'=>Ref::getActiveStatus()])
            ->limit(10)
            ->asArray()
            ->all();

        $out['results'] = array_values($model);

        return $out;
    }

    public function actionAnggotaFormatted($q = null, $id = null)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $model = MstAnggota::find()
            ->andFilterWhere(['LIKE','nama',$q])
            ->limit(5)
            ->all();

        if ($model){

            foreach($model as $result){
                $out['results'][] = [
                    'id'=>$result['id'],
                    'text'=>$result,
                    'avatar'=>$result->getAvatar(),
                    'nama'=>$result['nama']
                ];
            }
    
        }else{
            $out['results'][] = ['id'=>'','text'=>[]];
        }
        
        return $out;
    }

    public function actionSimpanan()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $group = DtGroupSimpanan::find()
            ->joinWith(['mstJenis'])
            ->where(['mst_unit_id'=>$id])
            ->all();

        if ($group){
            foreach($group as $g){
                $result[] = ['id'=>$g['mst_jenis_id'],'nama'=>$g->mstJenis->nama];
            }
        }else{
            $result=[];
        }

        return $result;
    }
}