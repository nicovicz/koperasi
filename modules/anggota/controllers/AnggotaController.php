<?php

namespace app\modules\anggota\controllers;

use Yii;
use app\models\MstAnggota;
use app\models\MstAnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        if ($model->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();
            try{

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
                    }
                } 

                if (!$model->save()){
                    throw new Exception('Data Anggota Koperasi Gagal Disimpan');
                    
                }
                
                // handling insert ke tabel simpanan
                $simpanan = new DtSimpanan();
                $simpanan->mst_anggota_id = $model->id;
                $simpanan->mst_jenis_id = Ref::getSimpananPokok();
                $simpanan->status_trx = Ref::getCommit();
                $simpanan->jumlah = $model->jumlah;
                $simpanan->tgl_trx = Ref::now();
                if (!$simpanan->save()){
                    
                    throw new Exception('Data Simpanan Gagal Disimpan');
                    
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
                    throw new Exception('Data Transaksi Gagal Disimpan');
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success','Anggota Koperasi Baru Berhasil Ditambahkan');
                return $this->refresh();
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
     * Updates an existing MstAnggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

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
