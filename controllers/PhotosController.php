<?php

namespace app\controllers;

use app\models\Location;
use app\models\Photo;
use yii;

class PhotosController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new Photo();
        $location = Location::findOne(['id' => yii::$app->session->get('last_location')]);

        if (yii::$app->request->isPost) {

            $model->file = yii\web\UploadedFile::getInstance($model, 'file');
            $model->locationId = $location->id;

            if ($model->file && ($model->type = yii::$app->request->post('Photo')['type']) && $model->validate()) {

                $filez = $model->saveFile(
                    yii::$app->basePath,
                    Photo::UPLOADS_FOLDER . $location->id . '/' . $model->file->baseName,
                    $model->file->extension);

                $model->photoPath = yii::$app->basePath . $filez;
                $model->file->saveAs(yii::$app->basePath . $filez);

                if ($model->save()) {
                    return $this->redirect('/location/view/' . $location->id);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,
            'location' => $location
        ]);
    }

}
