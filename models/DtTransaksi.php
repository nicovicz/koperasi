<?php

namespace app\models;

use Yii;
use thamtech\uuid\helpers\UuidHelper;

/**
 * This is the model class for table "{{%dt_transaksi}}".
 *
 * @property string $id
 * @property string|null $tgl_trx
 * @property float $jumlah
 * @property int $status_trx
 * @property string $ref_id
 * @property string $tipe
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class DtTransaksi extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;
    use \app\helpers\AuditLogTrait;
    
    public $instance;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dt_transaksi}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'],'default','value'=>UuidHelper::uuid()],
            [['jumlah', 'status_trx', 'ref_id', 'tipe'], 'required'],
            [['tgl_trx', 'created_at', 'updated_at'], 'safe'],
            [['jumlah'], 'number'],
            [['status_trx', 'created_by', 'updated_by'], 'integer'],
            [['id', 'ref_id'], 'string', 'max' => 64],
            [['tipe'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tgl_trx' => Yii::t('app', 'Tgl Trx'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'status_trx' => Yii::t('app', 'Status Trx'),
            'ref_id' => Yii::t('app', 'Ref ID'),
            'tipe' => Yii::t('app', 'Tipe'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

   
}
