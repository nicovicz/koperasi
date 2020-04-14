<?php

namespace app\models;

use Yii;
use thamtech\uuid\helpers\UuidHelper;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%mst_anggota}}".
 *
 * @property string $id
 * @property string|null $nip
 * @property string $nama
 * @property string|null $jk
 * @property string|null $jabatan
 * @property string|null $golongan
 * @property string|null $bagian
 * @property string|null $sub_bagian
 * @property string|null $foto
 * @property string|null $telp
 * @property string|null $email
 * @property string|null $alamat
 * @property string $mst_status_id
 * @property string $mst_unit_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DtPinjaman[] $dtPinjamen
 * @property DtSimpanan[] $dtSimpanans
 * @property MstStatus $mstStatus
 * @property MstUnit $mstUnit
 */
class MstAnggota extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;

    public $fotoTemp;
    public $jumlah;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mst_anggota}}';
    }

    

    public function getUploadDir()
    {
        return Yii::getAlias('@uploadAnggota').'/'.$this->nip.'/';
    }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fotoTemp'],'safe'],
            [['jumlah'],'number'],
            [['id'],'default','value'=>UuidHelper::uuid()],
            [['nama', 'mst_status_id', 'mst_unit_id'], 'required'],
            [['alamat'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['id', 'mst_status_id', 'mst_unit_id'], 'string', 'max' => 64],
            [['foto'],'file','extensions'=>['jpg','jpeg','png']],
            [['nip', 'nama', 'jk', 'jabatan', 'golongan', 'bagian', 'sub_bagian',  'telp', 'email'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['mst_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstStatus::className(), 'targetAttribute' => ['mst_status_id' => 'id']],
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
            'nip' => Yii::t('app', 'Nip'),
            'nama' => Yii::t('app', 'Nama'),
            'jk' => Yii::t('app', 'Jk'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'golongan' => Yii::t('app', 'Golongan'),
            'bagian' => Yii::t('app', 'Bagian'),
            'sub_bagian' => Yii::t('app', 'Sub Bagian'),
            'foto' => Yii::t('app', 'Foto'),
            'telp' => Yii::t('app', 'Telp'),
            'email' => Yii::t('app', 'Email'),
            'alamat' => Yii::t('app', 'Alamat'),
            'mst_status_id' => Yii::t('app', 'Mst Status ID'),
            'mst_unit_id' => Yii::t('app', 'Mst Unit ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
        return $this->hasMany(DtPinjaman::className(), ['mst_anggota_id' => 'id']);
    }

    /**
     * Gets query for [[DtSimpanans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDtSimpanans()
    {
        return $this->hasMany(DtSimpanan::className(), ['mst_anggota_id' => 'id']);
    }

    /**
     * Gets query for [[MstStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMstStatus()
    {
        return $this->hasOne(MstStatus::className(), ['id' => 'mst_status_id']);
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
