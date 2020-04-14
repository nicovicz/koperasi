<?php
namespace app\helpers;

use app\models\DtSimpanan;
use app\models\DtTransLog;
use app\models\MstJenis;
use yii\helpers\ArrayHelper;

trait AuditLogTrait
{
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $model = new DtTransLog();
        $jenis = ArrayHelper::map(MstJenis::find()->all(),'id','nama');
        if (!$jenis){
            return false;
        }
        if (property_exists($this,'instance')){
            if ($this->instance instanceof DtSimpanan){
               

                if (array_key_exists($this->instance->mst_jenis_id,$jenis)){
                    $model->data = serialize($this->instance->attributes);
                    $model->pesan = 'Melakukan '.$jenis[$this->instance->mst_jenis_id];
                    return $model->save();
                }
               
            }
        }

        return false;
    }

}