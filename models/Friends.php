<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property int $id
 * @property int $idUser1
 * @property int $idUser2
 *
 * @property User $user1
 * @property User $user2
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser1', 'idUser2'], 'required'],
            [['idUser1', 'idUser2'], 'integer'],
            [['idUser1'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser1' => 'id']],
            [['idUser2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser1' => 'Id User1',
            'idUser2' => 'Id User2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser2']);
    }
}
