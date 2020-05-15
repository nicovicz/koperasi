<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dt_group_simpanan}}".
 *
 * @property string $id
 * @property string $mst_jenis_id
 * @property string $mst_unit_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property MstJenis $mstJenis
 * @property MstUnit $mstUnit
 */
class DtGroupSimpanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dt_group_simpanan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mst_jenis_id', 'mst_unit_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['id'], 'string', 'max' => 64],
            [['mst_jenis_id', 'mst_unit_id'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['mst_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstJenis::className(), 'targetAttribute' => ['mst_jenis_id' => 'id']],
            [['mst_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstUnit::className(), 'targetAttribute' => ['mst_unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mst_jenis_id' => Yii::t('app', 'Mst Jenis ID'),
            'mst_unit_id' => Yii::t('app', 'Mst Unit ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
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

    /**
     * Gets query for [[MstUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMstUnit()
    {
        return $this->hasOne(MstUnit::className(), ['id' => 'mst_unit_id']);
    }
}
