<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "refugee".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $phone
 * @property string $document_number
 * @property int $age
 * @property int $gender
 * @property string $pickup_location
 * @property string $destination_location
 * @property string|null $special_needs
 * @property string|null $lang
 * @property int|null $assigned_house_id
 * @property int|null $assigned_trip_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property HouseGuest[] $houseGuests
 * @property TripPassenger[] $tripPassengers
 * @property User $user
 */
class Refugee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refugee';
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
            [['name', 'phone', 'document_number', 'age', 'gender', 'pickup_location', 'destination_location'], 'required'],
            [['age', 'gender', 'created_at', 'updated_at'], 'integer'],
            [['special_needs'], 'string'],
            [['name', 'pickup_location', 'destination_location'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 32],
            [['document_number'], 'string', 'max' => 64],
            [['lang'], 'string', 'max' => 5],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common.models.refugee', 'User'),
            'name' => Yii::t('common.models.refugee', 'Name'),
            'phone' => Yii::t('common.models.refugee', 'Phone'),
            'document_number' => Yii::t('common.models.refugee', 'Document Number'),
            'age' => Yii::t('common.models.refugee', 'Age'),
            'gender' => Yii::t('common.models.refugee', 'Gender'),
            'pickup_location' => Yii::t('common.models.refugee', 'Pickup Location'),
            'destination_location' => Yii::t('common.models.refugee', 'Destination Location'),
            'special_needs' => Yii::t('common.models.refugee', 'Special Needs'),
            'lang' => Yii::t('common.models.refugee', 'Language'),
            'assigned_house_id' => Yii::t('common.models.refugee', 'House'),
            'assigned_trip_id' => Yii::t('common.models.refugee', 'Trip'),
            'created_at' => Yii::t('common.models.refugee', 'Created At'),
            'updated_at' => Yii::t('common.models.refugee', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[HouseGuests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouseGuests()
    {
        return $this->hasMany(HouseGuest::className(), ['refugee_id' => 'id']);
    }

    /**
     * Gets query for [[TripPassengers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTripPassengers()
    {
        return $this->hasMany(TripPassenger::className(), ['refugee_id' => 'id']);
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
    
    const GENDER_MALE=1;
    const GENDER_FEMALE=0;
    const GENDER_OTHER=2;
    
    static public function getGenderList() {
        return [
            self::GENDER_FEMALE=>Yii::t('common.models.refugee', 'Female'),
            self::GENDER_MALE=>Yii::t('common.models.refugee', 'Male'),
            self::GENDER_OTHER=>Yii::t('common.models.refugee', 'Other'),
        ];
    }
    
    public function getGenderLabel() {
        $list=self::getGenderList();
        if (isset($list[$this->gender])) {
            return $list[$this->gender];
        }
        return $this->gender;
    }
}
