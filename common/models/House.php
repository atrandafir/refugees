<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "house".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $host_name
 * @property string $host_phone
 * @property string $host_document_number
 * @property string $address
 * @property string $city
 * @property string $postal_code
 * @property int $capacity
 * @property int $rooms
 * @property string|null $availability_date
 * @property string|null $lang
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property HouseGuest[] $houseGuests
 * @property User $user
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house';
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
            [['user_id', 'capacity', 'rooms', 'created_at', 'updated_at'], 'integer'],
            [['host_name', 'host_phone', 'host_document_number', 'address', 'city', 'postal_code', 'capacity', 'rooms'], 'required'],
            [['availability_date'], 'safe'],
            [['host_name', 'address', 'city'], 'string', 'max' => 128],
            [['host_phone', 'postal_code'], 'string', 'max' => 32],
            [['host_document_number'], 'string', 'max' => 64],
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
            'user_id' => Yii::t('common.models.house', 'User'),
            'host_name' => Yii::t('common.models.house', 'Host Name'),
            'host_phone' => Yii::t('common.models.house', 'Host Phone'),
            'host_document_number' => Yii::t('common.models.house', 'Host Document Number'),
            'address' => Yii::t('common.models.house', 'Address'),
            'city' => Yii::t('common.models.house', 'City'),
            'postal_code' => Yii::t('common.models.house', 'Postal Code'),
            'capacity' => Yii::t('common.models.house', 'Capacity'),
            'rooms' => Yii::t('common.models.house', 'Rooms'),
            'availability_date' => Yii::t('common.models.house', 'Availability Date'),
            'lang' => Yii::t('common.models.house', 'Language'),
            'created_at' => Yii::t('common.models.house', 'Created At'),
            'updated_at' => Yii::t('common.models.house', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[HouseGuests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouseGuests()
    {
        return $this->hasMany(HouseGuest::className(), ['house_id' => 'id']);
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
        return $this->host_name;
    }
}
