<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mst_jenis}}".
 *
 * @property string $id
 * @property string $nama
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DtPinjaman[] $dtPinjamen
 * @property DtSimpanan[] $dtSimpanans
 */
class MstJenis extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mst_jenis}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['id'], 'string', 'max' => 64],
            [['nama'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'created_at' => Yii::t('app', 'Dibuat Pada'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Diubah Pada'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[DtPinjamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtPinjamen()
    {
        return $this->hasMany(DtPinjaman::className(), ['mst_jenis_id' => 'id']);
    }

    /**
     * Gets query for [[DtSimpanans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtSimpanans()
    {
        return $this->hasMany(DtSimpanan::className(), ['mst_jenis_id' => 'id']);
    }
}
