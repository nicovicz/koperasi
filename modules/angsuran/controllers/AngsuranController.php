<?php

namespace app\modules\angsuran\controllers;

use Yii;
use app\models\DtAngsuran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;
use app\helpers\Ref;
use app\models\DtTransaksi;

/**
 * AngsuranController implements the CRUD actions for DtAngsuran model.
 */
class AngsuranController extends Controller
{
    use \app\helpers\AuthGuardTrait;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $message=[];

        if ($model->status_trx == Ref::getCommit()){
            $message=[
                'status'=>'success',
                'message'=>'Angsuran Ke-'.$model->angsuran_ke.' Sudah Lunas'
            ];
        }

        $model->tgl_trx = Ref::now();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                $model->status_trx = Ref::getCommit();

                if (!$model->save()){
                    throw new Exception('Angsuran Pembayaran Gagal Disimpan');
                }

                $trx = new DtTransaksi();
                $trx->jumlah = $model->jumlah;
                $trx->tgl_trx = $model->tgl_trx;
                $trx->status_trx = Ref::getCommit();
                $trx->ref_id = $model->id;
                $trx->tipe =  Ref::debit();
                $trx->instance=$model;
                if (!$trx->save()){
                    throw new Exception('Angsuran Pembayaran Gagal Disimpan');
                }
                $transaction->commit();

                $message=[
                    'status'=>'success',
                    'message'=>'Angsuran Ke-'.$model->angsuran_ke.' Sudah Lunas'
                ];
            }catch(Exception $e){
                $transaction->rollback();
                $message=[
                    'status'=>'error',
                    'message'=>$e->getMessage()
                ];
                
            }
            
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'message'=>$message
        ]);
    }

  

    /**
     * Deletes an existing DtAngsuran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DtAngsuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DtAngsuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DtAngsuran::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
