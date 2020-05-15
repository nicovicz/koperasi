<?php

namespace app\modules\anggota\controllers;

use Yii;
use app\models\MstAnggota;
use app\models\MstAnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use thamtech\uuid\helpers\UuidHelper;
use app\helpers\Ref;
use yii\db\Exception;
use app\models\DtSimpanan;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use app\models\DtTransaksi;
/**
 * AnggotaController implements the CRUD actions for MstAnggota model.
 */
class AnggotaController extends Controller
{
    

    /**
     * Lists all MstAnggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MstAnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MstAnggota model.
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
     * Creates a new MstAnggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MstAnggota();
        $model->mst_status_id = Ref::getActiveStatus();
        $model->jumlah = Ref::getJumlahSimpananWajib();
        if ($model->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();
            try{

                // handling upload photo anggota
                $photoName = UuidHelper::uuid().'.';
                if (!is_dir($model->getUploadDir())){
                    FileHelper::createDirectory($model->getUploadDir());
                }

                if (!empty($model->fotoTemp)){

                    $model->foto = UploadedFile::getInstance($model,'foto');

                    if ($model->foto){
                        
                        if ($model->foto->saveAs($model->getUploadDir().$photoName)){
                            $model->foto = $photoName;
                        }
                    }else{
                        $getPartSchemas = explode('/',$model->fotoTemp);
                        $lastSchema = explode('.',end($getPartSchemas));
                        $getExtension = end($lastSchema);
                        
                        file_put_contents($model->getUploadDir().$photoName,file_get_contents($model->fotoTemp));
                        $model->foto = $photoName;
                    }
                }else{
                    $model->foto = UploadedFile::getInstance($model,'foto');

                    if ($model->foto){
                        
                        if ($model->foto->saveAs($model->getUploadDir().$photoName)){
                            $model->foto = $photoName;
                        }
                    }
                } 

                if (!$model->save()){
                    throw new Exception('Data Anggota Koperasi Gagal Disimpan');
                    
                }
                
                // handling insert ke tabel simpanan
                $simpanan = new DtSimpanan();
                $simpanan->mst_anggota_id = $model->id;
                $simpanan->mst_jenis_id = Ref::getSimpananWajib();
                $simpanan->status_trx = Ref::getCommit();
                $simpanan->jumlah = $model->jumlah;
                $simpanan->tgl_trx = Ref::now();
                if (!$simpanan->save()){
                   
                    throw new Exception('Data Anggota Koperasi Gagal Disimpan');
                    
                }


                // handling insert ke tabel transaksi
                $trx = new DtTransaksi();
                $trx->jumlah = $model->jumlah;
                $trx->tgl_trx = Ref::now();
                $trx->status_trx = Ref::getCommit();
                $trx->ref_id = $simpanan->id;
                $trx->tipe =  Ref::debit();
                $trx->instance=$simpanan;
                if (!$trx->save()){
                    throw new Exception('Data Anggota Koperasi Gagal Disimpan');
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success','Anggota Koperasi Berhasil Disimpan');
                
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
     * Updates an existing MstAnggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_foto = $model->foto;

        if ($model->load(Yii::$app->request->post())) {

             // handling upload photo anggota
             $photoName = UuidHelper::uuid().'.';
             if (!is_dir($model->getUploadDir())){
                 FileHelper::createDirectory($model->getUploadDir());
             }

             if (!empty($model->fotoTemp)){
                 $getPartSchemas = explode('/',$model->fotoTemp);
                 $lastSchema = explode('.',end($getPartSchemas));
                 $getExtension = end($lastSchema);
                 
                 file_put_content($model->getUploadDir().$photoName,file_get_contents($model->fotoTemp));
                 $model->foto = $photoName;
             }else{
                 $model->foto = UploadedFile::getInstance($model,'foto');

                 if ($model->foto){
                     
                     if ($model->foto->saveAs($model->getUploadDir().$photoName)){
                         $model->foto = $photoName;
                     }

                }else{
                    $model->foto = $old_foto;
                }
             } 

            if ($model->save()){
                Yii::$app->session->setFlash('success','Data Anggota Koperasi Berhasil Diubah'); 
            }else{
                Yii::$app->session->setFlash('error','Data Anggota Koperasi Gagal Diubah'); 
            }

            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MstAnggota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->mst_status_id == Ref::getActiveStatus()){
            $model->mst_status_id = Ref::getNonActiveStatus();
            $message = 'Dinonaktifkan';
        }else{
            $model->mst_status_id = Ref::getActiveStatus();
            $message = 'Diaktifkan';
        }
        
        if ($model->save()){
            Yii::$app->session->setFlash('success','Data Anggota Koperasi Berhasil '.$message);
        }else{
            Yii::$app->session->setFlash('error','Data Anggota Koperasi Gagal '.$message);
        }
       
        return $this->redirect(['index']);
    }

    /**
     * Finds the MstAnggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MstAnggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MstAnggota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
