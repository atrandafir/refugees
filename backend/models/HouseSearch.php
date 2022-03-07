<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;

/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseSearch extends House
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'capacity', 'rooms', 'created_at', 'updated_at'], 'integer'],
            [['host_name', 'host_phone', 'host_document_number', 'address', 'city', 'postal_code', 'availability_date', 'lang'], 'safe'],
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
        $query = House::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'capacity' => $this->capacity,
            'rooms' => $this->rooms,
            'availability_date' => $this->availability_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'host_name', $this->host_name])
            ->andFilterWhere(['like', 'host_phone', $this->host_phone])
            ->andFilterWhere(['like', 'host_document_number', $this->host_document_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'lang', $this->lang]);

        return $dataProvider;
    }
}
