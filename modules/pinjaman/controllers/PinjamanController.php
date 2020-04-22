<?php

namespace app\modules\pinjaman\controllers;

use Yii;
use app\models\DtPinjaman;
use app\models\DtAngsuran;
use app\models\DtTransaksi;
use app\models\DtPinjamanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\Exception;
use app\helpers\Ref;
/**
 * PinjamanController implements the CRUD actions for DtPinjaman model.
 */
class PinjamanController extends Controller
{
    

    /**
     * Lists all DtPinjaman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DtPinjamanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DtPinjaman model.
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
     * Creates a new DtPinjaman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DtPinjaman();

        if ($model->load(Yii::$app->request->post())) {
            

            if ($model->jumlah > Ref::getSisaSaldo()){
                Yii::$app->session->setFlash('error','Saldo Tabungan Koperasi Tidak Cukup');
                return $this->refresh();
            }

            $transaction = Yii::$app->db->beginTransaction();
            try{


                // save data pinjaman
                $model->status_trx =  Ref::getCommit();
                $model->status_pinjaman = Ref::getActiveStatus();
                $model->mst_jenis_id = Ref::getPinjaman();

                if (!$model->save()){
                    var_dump($model->errors);die;
                    throw new Exception('Pinjaman Koperasi Gagal Disimpan');
                }

                // save data angsuran

                $pokok = $model->jumlah / $model->tenor;
                $bunga = (($model->bunga/100)*$model->jumlah)/12;
                for($i=1;$i<=$model->tenor;$i++){
                    $angsuran = new DtAngsuran();
                    $angsuran->dt_pinjaman_id = $model->id;
                    $angsuran->angsuran_pokok = $pokok;
                    $angsuran->angsuran_bunga = $bunga;
                    $angsuran->angsuran_ke = $i;
                    $angsuran->status_trx = Ref::getInit();
                    if (!$angsuran->save()){
                        throw new Exception('Data Angsuran Gagal Disimpan');
                    }
                }

                // handling insert ke tabel transaksi
                $trx = new DtTransaksi();
                $trx->jumlah = -$model->jumlah;
                $trx->tgl_trx = Ref::now();
                $trx->status_trx = Ref::getCommit();
                $trx->ref_id = $model->id;
                $trx->tipe =  Ref::kredit();
                $trx->instance=$model;
                if (!$trx->save()){
                    throw new Exception('Data Transaksi Gagal Disimpan');
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success','Pinjaman Koperasi Berhasil Disimpan');

            }catch(Exception $e){
                $transaction->rollback();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

   
    /**
     * Deletes an existing DtPinjaman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the DtPinjaman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DtPinjaman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DtPinjaman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
