<?php

namespace app\modules\angsuran\controllers;

use Yii;
use app\models\DtAngsuran;
use app\models\DtPinjaman;
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
        $model->jumlah = $model->angsuran_pokok + $model->angsuran_bunga;
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

                $cekLunas = DtAngsuran::find()->where([
                    'dt_pinjaman_id'=>$model->dt_pinjaman_id,
                    'status_trx' => Ref::getInit(),
                    'tgl_trx'=>'is null'
                ])->count();

                if (empty($cekLunas)){
                    $pinjaman = DtPinjaman::findOne($model->dt_pinjaman_id);
                    if ($pinjaman){
                        $pinjaman->status_pinjaman = Ref::getNonActiveStatus();
                        if (!$pinjaman->save()){
                            throw new Exception('Set Flag Lunas Peminjaman Gagal Disimpan :');
                        }
                    }
                }
                $transaction->commit();

                $message=[
                    'status'=>'success',
                    'message'=>'Angsuran Ke-'.$model->angsuran_ke.' Sudah Lunas'
                ];
            }catch(Exception $e){
                $transaction->rollback();
                $message=[
                    'status'=>'danger',
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
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->findModel($id);
        try{
            if ($model->isBelumBayar()){
                throw new Exception('Angsuran Pembayaran Gagal Dihapus');
            }


            $model->status_trx = Ref::getRollback();
            if (!$model->save()){
                throw new Exception('Angsuran Pembayaran Gagal Dihapus');
            }
            

            $angsuran = new DtAngsuran();
            $angsuran->dt_pinjaman_id = $model->dt_pinjaman_id;
            $angsuran->angsuran_pokok = $model->angsuran_pokok;
            $angsuran->angsuran_bunga = $model->angsuran_bunga;
            $angsuran->angsuran_ke = $model->angsuran_ke;
            $angsuran->jumlah = 0;
            $angsuran->status_trx = Ref::getInit();
            if (!$angsuran->save()){
                throw new Exception('Data Angsuran Gagal Disimpan');
            }

            $pinjaman = DtPinjaman::findOne($model->dt_pinjaman_id);
            if ($pinjaman){
                $pinjaman->status_pinjaman = Ref::getActiveStatus();
                if (!$pinjaman->save()){
                    throw new Exception('Set Flag Belum Lunas Peminjaman Gagal Disimpan :');
                }
            }

            $trx = new DtTransaksi();
            $trx->jumlah = $model->jumlah;
            $trx->tgl_trx = $model->tgl_trx;
            $trx->status_trx = Ref::getRollback();
            $trx->ref_id = $model->id;
            $trx->tipe =  Ref::debit();
            $trx->instance=$model;
            if (!$trx->save()){
                throw new Exception('Angsuran Pembayaran Gagal Disimpan');
            }

            $transaction->commit();
            Yii::$app->session->setFlash('success','Berhasil Membatalkan Pembayaran');
        }catch(Exception $e){
            $transaction->rollback();
            Yii::$app->session->setFlash('error',$e->getMessage());
                  
        }
       
        return $this->redirect(['/pinjaman/pinjaman/view','id'=>$model->dt_pinjaman_id]);
        


        
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
