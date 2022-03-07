<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trip".
 *
 * @property int $id
 * @property int|null $coordinator_id
 * @property string $leaving_from
 * @property string|null $current_location
 * @property string|null $pickup_arrival_date
 * @property string|null $destination_arrival_date
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $coordinator
 * @property TripPassenger[] $tripPassengers
 * @property Vehicle[] $vehicles
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coordinator_id', 'created_at', 'updated_at'], 'integer'],
            [['leaving_from'], 'required'],
            [['pickup_arrival_date', 'destination_arrival_date'], 'safe'],
            [['leaving_from', 'current_location'], 'string', 'max' => 128],
            [['coordinator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['coordinator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common.models.trip', 'ID'),
            'coordinator_id' => Yii::t('common.models.trip', 'Coordinator ID'),
            'leaving_from' => Yii::t('common.models.trip', 'Leaving From'),
            'current_location' => Yii::t('common.models.trip', 'Current Location'),
            'pickup_arrival_date' => Yii::t('common.models.trip', 'Pickup Arrival Date'),
            'destination_arrival_date' => Yii::t('common.models.trip', 'Destination Arrival Date'),
            'created_at' => Yii::t('common.models.trip', 'Created At'),
            'updated_at' => Yii::t('common.models.trip', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Coordinator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinator()
    {
        return $this->hasOne(User::className(), ['id' => 'coordinator_id']);
    }

    /**
     * Gets query for [[TripPassengers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTripPassengers()
    {
        return $this->hasMany(TripPassenger::className(), ['trip_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['current_trip_id' => 'id']);
    }
}
