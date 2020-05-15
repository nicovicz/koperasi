<?php

namespace app\models;

use Yii;
use thamtech\uuid\helpers\UuidHelper;
use app\helpers\Ref;
/**
 * This is the model class for table "{{%dt_pinjaman}}".
 *
 * @property string $id
 * @property string $tgl_trx
 * @property float $jumlah
 * @property float $bunga
 * @property int $tenor
 * @property int $status_trx
 * @property int $status_pinjaman
 * @property string $mst_anggota_id
 * @property string $mst_jenis_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DtAngsuran[] $dtAngsurans
 * @property MstAnggota $mstAnggota
 * @property MstJenis $mstJenis
 * @property MstStatus $statusPinjaman
 * @property MstTrx $statusTrx
 * @property MstTrx $statusTrx0
 */
class DtPinjaman extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dt_pinjaman}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'],'default','value'=>UuidHelper::uuid()],
            [['tgl_trx', 'jumlah', 'tenor', 'status_trx', 'status_pinjaman', 'mst_anggota_id', 'mst_jenis_id'], 'required'],
            [['tgl_trx', 'created_at', 'updated_at','bunga'], 'safe'],
            [['jumlah', 'bunga','tenor',], 'number'],
            [[ 'status_trx', 'status_pinjaman', 'created_by', 'updated_by'], 'integer'],
            [['id', 'mst_anggota_id', 'mst_jenis_id'], 'string', 'max' => 64],
            [['id'], 'unique'],
            [['mst_anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstAnggota::className(), 'targetAttribute' => ['mst_anggota_id' => 'id']],
            [['mst_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstJenis::className(), 'targetAttribute' => ['mst_jenis_id' => 'id']],
            [['status_pinjaman'], 'exist', 'skipOnError' => true, 'targetClass' => MstStatus::className(), 'targetAttribute' => ['status_pinjaman' => 'id']],
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
            'tgl_trx' => Yii::t('app', 'Tanggal Transaksi'),
            'jumlah' => Yii::t('app', 'Jumlah Pinjaman'),
            'bunga' => Yii::t('app', 'Bunga'),
            'tenor' => Yii::t('app', 'Cicilan'),
            'status_trx' => Yii::t('app', 'Status Trx'),
            'status_pinjaman' => Yii::t('app', 'Status Pinjaman'),
            'mst_anggota_id' => Yii::t('app', 'Nama Anggota'),
            'mst_jenis_id' => Yii::t('app', 'Mst Jenis ID'),
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
        return $this->hasMany(DtAngsuran::className(), ['dt_pinjaman_id' => 'id'])
            ->orderBy(['angsuran_ke'=>SORT_ASC]);
    }

    public function getJumlahAngsuranLunas()
    {
        return $this->hasMany(DtAngsuran::className(), ['dt_pinjaman_id' => 'id'])
            ->where(['dt_angsuran.status_trx'=>Ref::getCommit()])
            ->andWhere('dt_angsuran.tgl_trx is not null')->count();
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

    /**
     * Gets query for [[StatusPinjaman]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPinjaman()
    {
        return $this->hasOne(MstStatus::className(), ['id' => 'status_pinjaman']);
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

    /**
     * Gets query for [[StatusTrx0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusTrx0()
    {
        return $this->hasOne(MstTrx::className(), ['id' => 'status_trx']);
    }

    public function getDisplayPinjaman()
    {
        return sprintf('<div class="name-container">
                       
                        <div>
                            <span class="small">Jumlah <strong>%s</strong></span>
                        </div>
                        <div  style="margin-top:-9%%">
                            <span class="small">Cicilan <i>%s Bulan</i></span>
                        </div>
                        <div style="margin-top:-9%%">
                            <span class="small">Bunga <i>%s %%</i></span>
                        </div>
                        <div style="margin-top:-9%%">
                            <span class="small">Angsuran %s</span>
                        </div>
                        
                        
                    </div>',
                        Yii::$app->formatter->asCurrency($this->jumlah),
                        $this->tenor,
                        $this->bunga,
                        $this->jumlahAngsuranLunas.'/'.$this->tenor);
                        
    }
}
