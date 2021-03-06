<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "badges".
 *
 * @property int $id
 * @property string $badgesName
 *
 * @property BadgesUser[] $badgesusers
 */
class Badge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['badgesName'], 'required'],
            [['badgesName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'badgesName' => 'Badge Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadgesUsers()
    {
        return $this->hasMany(BadgesUser::className(), ['idBadges' => 'id']);
    }
}
