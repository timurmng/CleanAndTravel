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
 * @property Badges $badges
 * @property Users $user
 */
class Badgesuser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badgesusers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idBadges'], 'required'],
            [['idUser', 'idBadges'], 'integer'],
            [['idBadges'], 'exist', 'skipOnError' => true, 'targetClass' => Badges::className(), 'targetAttribute' => ['idBadges' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['idUser' => 'id']],
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
    public function getBadges()
    {
        return $this->hasOne(Badges::className(), ['id' => 'idBadges']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'idUser']);
    }
}
