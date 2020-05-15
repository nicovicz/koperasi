<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DtPinjaman;

/**
 * DtPinjamanSearch represents the model behind the search form of `app\models\DtPinjaman`.
 */
class DtPinjamanSearch extends DtPinjaman
{
    public $nama,$unit,$nip,$sub_bagian;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama','unit','nip','sub_bagian'],'safe'],
            [['id', 'tgl_trx', 'mst_anggota_id', 'mst_jenis_id', 'created_at', 'updated_at'], 'safe'],
            [['jumlah', 'bunga'], 'number'],
            [['tenor', 'status_trx', 'status_pinjaman', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DtPinjaman::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tgl_trx' => $this->tgl_trx,
            'jumlah' => $this->jumlah,
            'bunga' => $this->bunga,
            'tenor' => $this->tenor,
            'status_trx' => $this->status_trx,
            'status_pinjaman' => $this->status_pinjaman,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'mst_anggota_id', $this->mst_anggota_id])
            ->andFilterWhere(['like', 'mst_jenis_id', $this->mst_jenis_id]);

        return $dataProvider;
    }
}
