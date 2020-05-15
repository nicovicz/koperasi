<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DtSimpanan;

/**
 * DtSimpananSearch represents the model behind the search form of `app\models\DtSimpanan`.
 */
class DtSimpananSearch extends DtSimpanan
{

    public $nama,$unit,$nip,$sub_bagian;
    public function init()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama','unit','nip','sub_bagian'],'safe'],
            [['id', 'tgl_trx', 'mst_jenis_id', 'mst_anggota_id', 'created_at', 'updated_at'], 'safe'],
            [['jumlah'], 'number'],
            [['status_trx', 'created_by', 'updated_by'], 'integer'],
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
        $query = DtSimpanan::find();
        $query->joinWith(['mstAnggota']);
        $query->orderBy(['updated_at'=>SORT_DESC,'status_trx'=>SORT_ASC]);
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
            'status_trx' => $this->status_trx,
        ]);

        $query->andFilterWhere(['like', 'mst_anggota.nip', $this->nip])
            ->andFilterWhere(['like', 'mst_anggota.nama', $this->nama])
            ->andFilterWhere(['like', 'mst_anggota.mst_unit_id', $this->unit])
            ->andFilterWhere(['like', 'mst_anggota.sub_bagian', $this->sub_bagian]);

        return $dataProvider;
    }
}
