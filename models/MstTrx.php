<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mst_trx}}".
 *
 * @property int $id
 * @property string $nama
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DtAngsuran[] $dtAngsurans
 * @property DtPinjaman[] $dtPinjamen
 * @property DtPinjaman[] $dtPinjamen0
 */
class MstTrx extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mst_trx}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama' => Yii::t('app', 'Nama'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[DtAngsurans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtAngsurans()
    {
        return $this->hasMany(DtAngsuran::className(), ['status_trx' => 'id']);
    }

    /**
     * Gets query for [[DtPinjamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtPinjamen()
    {
        return $this->hasMany(DtPinjaman::className(), ['status_trx' => 'id']);
    }

    /**
     * Gets query for [[DtPinjamen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtPinjamen0()
    {
        return $this->hasMany(DtPinjaman::className(), ['status_trx' => 'id']);
    }
}
