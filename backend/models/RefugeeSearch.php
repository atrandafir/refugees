<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Refugee;

/**
 * RefugeeSearch represents the model behind the search form of `common\models\Refugee`.
 */
class RefugeeSearch extends Refugee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'gender', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone', 'document_number', 'pickup_location', 'destination_location', 'special_needs', 'lang'], 'safe'],
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
        $query = Refugee::find();

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
            'age' => $this->age,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'document_number', $this->document_number])
            ->andFilterWhere(['like', 'pickup_location', $this->pickup_location])
            ->andFilterWhere(['like', 'destination_location', $this->destination_location])
            ->andFilterWhere(['like', 'special_needs', $this->special_needs])
            ->andFilterWhere(['like', 'lang', $this->lang]);

        return $dataProvider;
    }
}
