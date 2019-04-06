<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "badgesusers".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idBadges
 *
 * @property Badge $badges
 * @property User $user
 */
class BadgesUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badgesUsers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idBadges'], 'required'],
            [['idUser', 'idBadges'], 'integer'],
            [['idBadges'], 'exist', 'skipOnError' => true, 'targetClass' => Badge::className(), 'targetAttribute' => ['idBadges' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'idBadges' => 'Id Badges',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadge()
    {
        return $this->hasOne(Badge::className(), ['id' => 'idBadges']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
