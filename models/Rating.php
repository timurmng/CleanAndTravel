<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property int $idUserRatings
 * @property int $locationIdRatings
 * @property int $rate
 *
 * @property User $userRatings
 * @property Location $locationIdRatings0
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUserRatings', 'locationIdRatings', 'rate'], 'required'],
            [['idUserRatings', 'locationIdRatings', 'rate'], 'integer'],
            [['idUserRatings'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUserRatings' => 'id']],
            [['locationIdRatings'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationIdRatings' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUserRatings' => 'Id User Ratings',
            'locationIdRatings' => 'Location Id Ratings',
            'rate' => 'Rate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRatings()
    {
        return $this->hasOne(User::className(), ['id' => 'idUserRatings']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationIdRatings0()
    {
        return $this->hasOne(Location::className(), ['id' => 'locationIdRatings']);
    }
}
