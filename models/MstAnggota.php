<?php

namespace app\models;

use Yii;
use thamtech\uuid\helpers\UuidHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\helpers\Ref;

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
            [['created_by', 'updated_by','mst_status_id'], 'integer'],
            [['id', 'mst_unit_id'], 'string', 'max' => 64],
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
            'nip' => Yii::t('app', 'NIP Pegawai'),
            'nama' => Yii::t('app', 'Nama Lengkap'),
            'jk' => Yii::t('app', 'Jenis Kelamin'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'golongan' => Yii::t('app', 'Golongan'),
            'bagian' => Yii::t('app', 'Bagian'),
            'sub_bagian' => Yii::t('app', 'Sub Bagian'),
            'foto' => Yii::t('app', 'Foto'),
            'telp' => Yii::t('app', 'Telp'),
            'email' => Yii::t('app', 'Email'),
            'alamat' => Yii::t('app', 'Alamat'),
            'mst_status_id' => Yii::t('app', 'Status Anggota'),
            'mst_unit_id' => Yii::t('app', 'Unit Kerja'),
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

    public function getAvatar()
    {
        return Url::to(['/site/preview','id'=>$this->id]);
    }

    public function getStatusAnggota()
    {
       
        $status = ArrayHelper::getValue($this,'mstStatus.data');
        $array_status = json_decode($status,true);
        if ($array_status){
            return sprintf('<span class="%s"><i class="%s"></i> %s</span>',
                $array_status['template'],
                $array_status['icon'],
                $array_status['label_anggota']);
        }

        return null;
    }

    public function getKetBergabung()
    {
        $status = ArrayHelper::getValue($this,'mstStatus');
        $array_status = json_decode($status->data,true);
        if ($array_status){
            if ($status['nama'] == 'Aktif'){
                return sprintf('<small><i>Aktif Pada : %s</i></small>',
                Yii::$app->formatter->asDate($this->created_at));
            }else{
                return sprintf('<small><i>Aktif Pada : %s</i> <br/> Nonaktif Pada  : %s</small>',
                Yii::$app->formatter->asDate($this->created_at),
                Yii::$app->formatter->asDate($this->updated_at)
                );
            }
        }

        return null;
    }

    public function getGenderTranslate()
    {
        return $this->jk=='L'?'Laki-Laki':'Perempuan';
    }

    public function getGenderIcon()
    {
        if ($this->jk=='L'){
            return [
                'icon_name'=> 'fa fa-male',
                'icon_gender'=> 'fa fa-mars'
            ];
        }

        return [
            'icon_name'=> 'fa fa-female',
            'icon_gender'=> 'fa fa-venus'
        ];
    }


    public function getDisplayAnggota()
    {
        return sprintf('<div class="name-container">
                        <div>
                            <span>%s / <strong>%s</strong></span>
                        </div>
                        <div>
                            <span>%s - %s</span>
                        </div>
                        <div style="margin-top:-2%%">
                            <span>%s</span>
                        </div>
                    </div>',
                        $this->nip,
                        $this->nama,
                        $this->jabatan,
                        $this->sub_bagian,
                        $this->bagian);
    }

    public function getDisplayAvatar()
    {
        return '<img class="img-circle" style="width:50px;height:50px;margin-top:20px" src="'.$this->getAvatar().'">';
    }

    public function getDetilDisplayAnggota()
    {
        return sprintf('<table class="table table-bordered">
                            <tr>
                                <td rowspan="4" width="120">
                                    <img  class="pull-left" style="width:120px;height:120px" src="%s"></td>
                                <td>%s</td><td>:</td><td></td>
                                <td>%s</td><td>:</td><td></td>
                            </tr>
                            <tr >
                               <td class="text-left-force" style="width:180px">%s</td>
                               <td style="width:10px">:</td><td></td>
                               <td>%s</td><td>:</td><td></td>
                            </tr>
                            <tr>
                               <td class="text-left-force">%s</td><td>:</td><td></td>
                            </tr>
                            <tr>
                               <td class="text-left-force">%s</td><td>:</td><td></td>
                            </tr>
                        </table>',
                        $this->getAvatar(),
                        $this->getAttributeLabel('nip'),
                        $this->getAttributeLabel('sub_bagian'),
                        $this->getAttributeLabel('nama'),
                        $this->getAttributeLabel('bagian'),
                        $this->getAttributeLabel('jabatan'),
                        $this->getAttributeLabel('golongan'));
                        
    }
}
