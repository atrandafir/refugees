<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trip_passenger".
 *
 * @property int $id
 * @property int $trip_id
 * @property int $refugee_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Refugee $refugee
 * @property Trip $trip
 */
class TripPassenger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip_passenger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trip_id', 'refugee_id'], 'required'],
            [['trip_id', 'refugee_id', 'created_at', 'updated_at'], 'integer'],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['trip_id' => 'id']],
            [['refugee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refugee::className(), 'targetAttribute' => ['refugee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trip_id' => 'Trip ID',
            'refugee_id' => 'Refugee ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Refugee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefugee()
    {
        return $this->hasOne(Refugee::className(), ['id' => 'refugee_id']);
    }

    /**
     * Gets query for [[Trip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'trip_id']);
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        
        $refugee= Refugee::findOne($this->refugee_id);
        if ($refugee) {
            $refugee->assigned_trip_id=$this->trip_id;
            $refugee->update(false, ['assigned_trip_id']);
        }
        
    }
    
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            $refugee= Refugee::findOne($this->refugee_id);
            if ($refugee) {
                $refugee->assigned_trip_id=NULL;
                $refugee->update(false, ['assigned_trip_id']);
            }
            return true;
        }
    }
}
