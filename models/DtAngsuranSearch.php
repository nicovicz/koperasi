<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DtAngsuran;

/**
 * DtAngsuranSearch represents the model behind the search form of `app\models\DtAngsuran`.
 */
class DtAngsuranSearch extends DtAngsuran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dt_pinjaman_id', 'tgl_trx', 'status_trx', 'created_at', 'updated_at'], 'safe'],
            [['angsuran_pokok', 'angsuran_bunga'], 'number'],
            [['angsuran_ke', 'created_by', 'updated_by'], 'integer'],
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
        $query = DtAngsuran::find();

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
            'angsuran_pokok' => $this->angsuran_pokok,
            'angsuran_bunga' => $this->angsuran_bunga,
            'angsuran_ke' => $this->angsuran_ke,
            'tgl_trx' => $this->tgl_trx,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'dt_pinjaman_id', $this->dt_pinjaman_id])
            ->andFilterWhere(['like', 'status_trx', $this->status_trx]);

        return $dataProvider;
    }
}
