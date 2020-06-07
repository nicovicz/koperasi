<?php
namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\MstUnit;
use app\models\MstStatus;
use app\models\MstJenis;
use app\models\MstTrx;

class Ref
{
    public static function getUnit()
    {
        return ArrayHelper::map(MstUnit::find()->all(),'id','nama');
    }

    public static function getStatus()
    {
        return ArrayHelper::map(MstStatus::find()->all(),'id','nama');
    }

    public static function getTrx()
    {
        return [1=>'Draft',2=>'Sukses',3=>'Batal'];
    }

    public static function getSimpananPokok()
    {
        $model = MstJenis::find()->where(['nama'=>'Simpanan Pokok'])->one();
        if ($model) return $model->id;
        return null;
        
    }

    public static function getJenisSimpanan($id)
    {
        $model = MstJenis::findOne($id);
        if ($model) return $model->nama;
        return null;
        
    }

    public static function getSimpananWajib()
    {
        $model = MstJenis::find()->where(['nama'=>'Simpanan Wajib'])->one();
        if ($model) return $model->id;
        return null;
        
    }

    public static function getJumlahSimpananWajib()
    {
        $model = MstJenis::find()->where(['nama'=>'Simpanan Wajib'])->one();
        if ($model) return $model->jumlah;
        return null;
    }

    public static function getPinjaman()
    {
        $model = MstJenis::find()->where(['nama'=>'Pinjaman Bunga Tetap'])->one();
        if ($model) return $model->id;
        return null;
        
    }

    public static function getNonActiveStatus()
    {
        $model = MstStatus::find()->where(['nama'=>'Non Aktif'])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function getActiveStatus()
    {
        $model = MstStatus::find()->where(['nama'=>'Aktif'])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function getSisaSaldo()
    {
        $model = Yii::$app->db->createCommand('
        SELECT SUM(jumlah) FROM dt_transaksi WHERE status_trx = :trx 
        ')
        ->bindValue(':trx', static::getCommit())
        ->queryScalar();

        return $model;
    }

    public static function getInit()
    {
        $model = MstTrx::find()->where(['nama'=>'init'])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function getCommit()
    {
        $model = MstTrx::find()->where(['nama'=>'commit'])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function getRollback()
    {
        $model = MstTrx::find()->where(['nama'=>'rollback'])->one();
        if ($model) return $model->id;
        return null;
    }

    public static function now()
    {
        return Yii::$app->formatter->asDate(time(),'php:Y-m-d');
    }

    public static function debit()
    {
        return 'D';
    }

    public static function kredit()
    {
        return 'K';
    }

    public static function trxTranslate($id)
    {
        $trx = [
            1 => '<label class="badge label-info badge"><i class="fa fa-book"></i> Draft</label>',
            2 => '<label class="badge label-success"><i class="fa fa-check-circle"></i> Sukses</label>',
            3 => '<label class="badge label-danger badge"><i class="fa fa-times-circle"></i> Batal</label>'
        ];

        return array_key_exists($id,$trx)?$trx[$id]:
        '<label class="badge label-danger badge"><i class="fa fa-times-circle"></i> Tidak Terdefinisi</label>';
    }

    public static function pinjamanTranslate($id)
    {
        $trx = [
           
            2 => '<label class="badge label-success small"><i class="fa fa-check-circle"></i> Lunas</label>',
            1 => '<label class="badge label-danger badge small"><i class="fa fa-times-circle"></i> Belum Lunas</label>'
        ];

        return array_key_exists($id,$trx)?$trx[$id]:
        '<label class="badge label-danger badge small"><i class="fa fa-times-circle"></i> Tidak Terdefinisi</label>';
    }

    public static function HitungPerBulan($modelPinjaman)
    {
        $pokok = $modelPinjaman->jumlah / $modelPinjaman->tenor;
        $bunga = ($modelPinjaman->bunga/100)*$modelPinjaman->jumlah;

        return [
            'pokok'=>$pokok,
            'bunga'=>$bunga
        ];
    }




}