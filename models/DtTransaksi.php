<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dt_transaksi}}".
 *
 * @property string $id
 * @property string|null $tgl_trx
 * @property float $jumlah
 * @property string $status_trx
 * @property string $ref_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class DtTransaksi extends \yii\db\ActiveRecord
{
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
            [['id', 'jumlah', 'status_trx', 'ref_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['tgl_trx', 'created_at', 'updated_at'], 'safe'],
            [['jumlah'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['id', 'status_trx', 'ref_id'], 'string', 'max' => 64],
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
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
