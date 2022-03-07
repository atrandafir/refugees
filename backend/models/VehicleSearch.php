<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form of `common\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'capacity', 'im_available', 'current_trip_id', 'created_at', 'updated_at'], 'integer'],
            [['driver_name', 'driver_phone', 'driver_document_number', 'brand_model', 'plate_number', 'current_location', 'lang'], 'safe'],
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
        $query = Vehicle::find();

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
            'im_available' => $this->im_available,
            'current_trip_id' => $this->current_trip_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'driver_name', $this->driver_name])
            ->andFilterWhere(['like', 'driver_phone', $this->driver_phone])
            ->andFilterWhere(['like', 'driver_document_number', $this->driver_document_number])
            ->andFilterWhere(['like', 'brand_model', $this->brand_model])
            ->andFilterWhere(['like', 'plate_number', $this->plate_number])
            ->andFilterWhere(['like', 'current_location', $this->current_location])
            ->andFilterWhere(['like', 'lang', $this->lang]);

        return $dataProvider;
    }
}
