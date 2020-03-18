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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tgl_trx', 'status_trx', 'mst_jenis_id', 'mst_anggota_id', 'created_at', 'updated_at'], 'safe'],
            [['jumlah'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
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
            'jumlah' => $this->jumlah,
            'tgl_trx' => $this->tgl_trx,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'status_trx', $this->status_trx])
            ->andFilterWhere(['like', 'mst_jenis_id', $this->mst_jenis_id])
            ->andFilterWhere(['like', 'mst_anggota_id', $this->mst_anggota_id]);

        return $dataProvider;
    }
}
