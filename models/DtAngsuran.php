<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dt_angsuran}}".
 *
 * @property string $id
 * @property string $dt_pinjaman_id
 * @property float $angsuran_pokok
 * @property float $angsuran_bunga
 * @property int $angsuran_ke
 * @property string $tgl_trx
 * @property string $status_trx
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DtPinjaman $dtPinjaman
 * @property MstTrx $statusTrx
 */
class DtAngsuran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dt_angsuran}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dt_pinjaman_id', 'angsuran_pokok', 'angsuran_bunga', 'angsuran_ke', 'tgl_trx', 'status_trx', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['angsuran_pokok', 'angsuran_bunga'], 'number'],
            [['angsuran_ke', 'created_by', 'updated_by'], 'integer'],
            [['tgl_trx', 'created_at', 'updated_at'], 'safe'],
            [['id', 'dt_pinjaman_id', 'status_trx'], 'string', 'max' => 64],
            [['id'], 'unique'],
            [['dt_pinjaman_id'], 'exist', 'skipOnError' => true, 'targetClass' => DtPinjaman::className(), 'targetAttribute' => ['dt_pinjaman_id' => 'id']],
            [['status_trx'], 'exist', 'skipOnError' => true, 'targetClass' => MstTrx::className(), 'targetAttribute' => ['status_trx' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dt_pinjaman_id' => Yii::t('app', 'Dt Pinjaman ID'),
            'angsuran_pokok' => Yii::t('app', 'Angsuran Pokok'),
            'angsuran_bunga' => Yii::t('app', 'Angsuran Bunga'),
            'angsuran_ke' => Yii::t('app', 'Angsuran Ke'),
            'tgl_trx' => Yii::t('app', 'Tgl Trx'),
            'status_trx' => Yii::t('app', 'Status Trx'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[DtPinjaman]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtPinjaman()
    {
        return $this->hasOne(DtPinjaman::className(), ['id' => 'dt_pinjaman_id']);
    }

    /**
     * Gets query for [[StatusTrx]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusTrx()
    {
        return $this->hasOne(MstTrx::className(), ['id' => 'status_trx']);
    }
}
