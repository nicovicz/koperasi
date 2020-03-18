<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dt_simpanan}}".
 *
 * @property string $id
 * @property float $jumlah
 * @property string $tgl_trx
 * @property string $status_trx
 * @property string $mst_jenis_id
 * @property string $mst_anggota_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property MstAnggota $mstAnggota
 * @property MstJenis $mstJenis
 */
class DtSimpanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dt_simpanan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jumlah', 'tgl_trx', 'status_trx', 'mst_jenis_id', 'mst_anggota_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['jumlah'], 'number'],
            [['tgl_trx', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['id', 'status_trx', 'mst_jenis_id', 'mst_anggota_id'], 'string', 'max' => 64],
            [['id'], 'unique'],
            [['mst_anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstAnggota::className(), 'targetAttribute' => ['mst_anggota_id' => 'id']],
            [['mst_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstJenis::className(), 'targetAttribute' => ['mst_jenis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'tgl_trx' => Yii::t('app', 'Tgl Trx'),
            'status_trx' => Yii::t('app', 'Status Trx'),
            'mst_jenis_id' => Yii::t('app', 'Mst Jenis ID'),
            'mst_anggota_id' => Yii::t('app', 'Mst Anggota ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[MstAnggota]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMstAnggota()
    {
        return $this->hasOne(MstAnggota::className(), ['id' => 'mst_anggota_id']);
    }

    /**
     * Gets query for [[MstJenis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMstJenis()
    {
        return $this->hasOne(MstJenis::className(), ['id' => 'mst_jenis_id']);
    }
}
