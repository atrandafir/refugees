<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $driver_name
 * @property string $driver_phone
 * @property string $driver_document_number
 * @property string $brand_model
 * @property string $plate_number
 * @property int $capacity
 * @property int $im_available
 * @property int|null $current_trip_id
 * @property string|null $current_location
 * @property string|null $lang
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Trip $currentTrip
 * @property User $user
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
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
            [['user_id', 'capacity', 'im_available', 'current_trip_id', 'created_at', 'updated_at'], 'integer'],
            [['driver_name', 'driver_phone', 'driver_document_number', 'brand_model', 'plate_number', 'capacity'], 'required'],
            [['driver_name', 'current_location'], 'string', 'max' => 128],
            [['driver_phone', 'plate_number'], 'string', 'max' => 32],
            [['driver_document_number', 'brand_model'], 'string', 'max' => 64],
            [['lang'], 'string', 'max' => 5],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['current_trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['current_trip_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common.models.vehicle', 'User'),
            'driver_name' => Yii::t('common.models.vehicle', 'Driver Name'),
            'driver_phone' => Yii::t('common.models.vehicle', 'Driver Phone'),
            'driver_document_number' => Yii::t('common.models.vehicle', 'Driver Document Number'),
            'brand_model' => Yii::t('common.models.vehicle', 'Brand Model'),
            'plate_number' => Yii::t('common.models.vehicle', 'Plate Number'),
            'capacity' => Yii::t('common.models.vehicle', 'Capacity'),
            'im_available' => Yii::t('common.models.vehicle', 'I\'m Available'),
            'current_trip_id' => Yii::t('common.models.vehicle', 'Current Trip'),
            'current_location' => Yii::t('common.models.vehicle', 'Current Location'),
            'lang' => Yii::t('common.models.vehicle', 'Language'),
            'created_at' => Yii::t('common.models.vehicle', 'Created At'),
            'updated_at' => Yii::t('common.models.vehicle', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[CurrentTrip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'current_trip_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getTitle() {
        return $this->driver_name . " - " . $this->brand_model;
    }
}
