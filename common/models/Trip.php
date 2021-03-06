<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "trip".
 *
 * @property int $id
 * @property int|null $coordinator_id
 * @property int|null $vehicle_id
 * @property string $leaving_from
 * @property string|null $current_location
 * @property string|null $pickup_location
 * @property string|null $destination_location
 * @property string|null $pickup_arrival_date
 * @property string|null $destination_arrival_date
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $coordinator
 * @property Vehicle $vehicle
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
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
            [['leaving_from', 'current_location','pickup_location','destination_location'], 'string', 'max' => 128],
            [['coordinator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['coordinator_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coordinator_id' => Yii::t('common.models.trip', 'Coordinator'),
            'vehicle_id' => Yii::t('common.models.trip', 'Vehicle'),
            'leaving_from' => Yii::t('common.models.trip', 'Leaving From'),
            'pickup_location' => Yii::t('common.models.trip', 'Pickup Location'),
            'destination_location' => Yii::t('common.models.trip', 'Destination Location'),
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
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
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
