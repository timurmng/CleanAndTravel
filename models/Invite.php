<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invites".
 *
 * @property int $id
 * @property int $idSender
 * @property int $idReceiver
 * @property int $location
 *
 * @property User $receiver
 * @property User $sender
 * @property Location $locationID
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSender', 'idReceiver', 'location'], 'required'],
            [['idSender', 'idReceiver', 'location'], 'integer'],
            [['idReceiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idReceiver' => 'id']],
            [['idSender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idSender' => 'id']],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idSender' => 'Id Sender',
            'idReceiver' => 'Id Receiver',
            'location' => 'Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'idReceiver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'idSender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::className(), ['id' => 'location']);
    }
}
