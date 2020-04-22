<?php
namespace app\helpers;

use app\models\DtSimpanan;
use app\models\DtPinjaman;
use app\models\DtTransLog;
use app\models\MstJenis;
use app\models\MstTrx;
use yii\helpers\ArrayHelper;

trait AuditLogTrait
{
    public function afterSave($insert, $changedAttributes)
    {
       
        parent::afterSave($insert, $changedAttributes);
        $model = new DtTransLog();
        $jenis = ArrayHelper::map(MstJenis::find()->all(),'id','nama');
        $trx = ArrayHelper::map(MstTrx::find()->all(),'id','nama');
        if (!$jenis || !$trx){
            return false;
        }
      
        if (property_exists($this,'instance')){
            
            if ($this->instance instanceof DtSimpanan || $this->instance instanceof DtPinjaman){
                
                if (array_key_exists($this->instance->mst_jenis_id,$jenis) && array_key_exists($this->instance->status_trx,$trx)){
                    $model->data = serialize($this->instance->attributes);
                    $nama_trx = $trx[$this->instance->status_trx];
                    $model->pesan = 'Melakukan '.$nama_trx.' '.$jenis[$this->instance->mst_jenis_id];
                    return $model->save();
                }
               
            }

          
        }

        return false;
    }

}