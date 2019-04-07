<?php

namespace app\models;

use Yii;
use yii\helpers\BaseFileHelper;

/**
 * This is the model class for table "photos".
 *
 * @property int $id
 * @property int $locationId
 * @property string $photoPath
 * @property int $type
 *
 * @property Location $location
 */
class Photo extends \yii\db\ActiveRecord
{
    const UPLOADS_FOLDER = '/web/uploads/';

    const TYPE_BEFORE = 1;
    const TYPE_AFTER = 2;

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locationId', 'type'], 'required'],
            [['file'], 'file', 'extensions' => 'jpg, jpeg, png, bmp'],
            [['locationId', 'type'], 'integer'],
            [['photoPath'], 'string', 'max' => 255],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locationId' => 'Location ID',
            'photoPath' => 'Photo Path',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'locationId']);
    }

    public function saveFile($path, $fileName, $extension)
    {
        $file = $fileName . '.' . $extension;
        try {
            BaseFileHelper::createDirectory($path . self::UPLOADS_FOLDER . $this->location->id);
        } catch (\Exception $exception) {
            print_r($exception->getMessage());
        }

        return $file;
    }
}
