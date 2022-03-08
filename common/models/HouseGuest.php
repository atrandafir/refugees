<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "house_guest".
 *
 * @property int $id
 * @property int $house_id
 * @property int $refugee_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property House $house
 * @property Refugee $refugee
 */
class HouseGuest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'house_guest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['house_id', 'refugee_id'], 'required'],
            [['house_id', 'refugee_id', 'created_at', 'updated_at'], 'integer'],
            [['house_id'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['house_id' => 'id']],
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
            'house_id' => 'House ID',
            'refugee_id' => 'Refugee ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[House]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'house_id']);
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
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        
        $refugee= Refugee::findOne($this->refugee_id);
        if ($refugee) {
            $refugee->assigned_house_id=$this->house_id;
            $refugee->update(false, ['assigned_house_id']);
        }
        
    }
    
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            $refugee= Refugee::findOne($this->refugee_id);
            if ($refugee) {
                $refugee->assigned_house_id=NULL;
                $refugee->update(false, ['assigned_house_id']);
            }
            return true;
        }
    }
}
