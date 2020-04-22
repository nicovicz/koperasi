<?php

namespace app\modules\simpanan\controllers;

use Yii;
use app\models\DtSimpanan;
use app\models\DtTransaksi;
use app\models\DtSimpananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\Exception;
use app\helpers\Ref;
/**
 * SimpananController implements the CRUD actions for DtSimpanan model.
 */
class SimpananController extends Controller
{
    

    /**
     * Lists all DtSimpanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DtSimpananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DtSimpanan model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DtSimpanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DtSimpanan();

        if ($model->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();
            try{
                
                // handling insert ke tabel simpanan
                $model->mst_jenis_id = Ref::getSimpananWajib();
                $model->status_trx = Ref::getCommit();
                
                if (!$model->save()){
                    
                    throw new Exception('Data Simpanan Gagal Disimpan');
                    
                }


                // handling insert ke tabel transaksi
                $trx = new DtTransaksi();
                $trx->jumlah = $model->jumlah;
                $trx->tgl_trx = Ref::now();
                $trx->status_trx = Ref::getCommit();
                $trx->ref_id = $model->id;
                $trx->tipe =  Ref::debit();
                $trx->instance=$model;
                if (!$trx->save()){
                    throw new Exception('Data Transaksi Gagal Disimpan');
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success','Simpanan Pokok Berhasil Ditambahkan');
                
            }catch(Exception $e){
                $transaction->rollback();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }

            return $this->refresh();
            
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    

    /**
     * Deletes an existing DtSimpanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = $this->findModel($id);
            $jenis = Ref::getJenisSimpanan($model->mst_jenis_id);
            $model->status_trx = Ref::getRollback();

            if (!$model->save()){
                throw new Exception('Transaksi Simpanan '.$jenis.' Gagal Dibatalkan');
            }

            // ambil data dt_transaksi untuk dibatalkan
            $transaksi = DtTransaksi::find()->where(['ref_id'=>$model->id])->one();
            if (!$transaksi){
                throw new Exception('Data Transaksi Hilang');
            }

            $transaksi->status_trx = Ref::getRollback();
            $transaksi->instance = $model;
            if (!$transaksi->save()){
                throw new Exception('Transaksi Simpanan '.$jenis.' Gagal Dibatalkan');
            }

            $transaction->commit();
            Yii::$app->session->setFlash('success','Transaksi Simpanan '.$jenis.' Berhasil Dibatalkan');

        }catch(Exception $e){
            $transaction->rollback();
            Yii::$app->session->setFlash('error',$e->getMessage());
        }
       
    
        return $this->redirect(['index']);
    }

    /**
     * Finds the DtSimpanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DtSimpanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DtSimpanan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
