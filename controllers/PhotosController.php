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

            $model->photoPath = yii\web\UploadedFile::getInstance($model, 'photoPath');
            $model->locationId = $location->id;

            if ($model->photoPath && ($model->type = yii::$app->request->post('Photo')['type']) && $model->validate()) {

                $filez = Photo::saveFile(
                    yii::$app->basePath,
                    Photo::UPLOADS_FOLDER . $location->id . '/' . $model->photoPath->baseName,
                    $model->photoPath->extension, $location->id);
                $model->photoPath->saveAs(yii::$app->basePath . $filez);
                $model->photoPath = yii::$app->basePath . $filez;
//                echo "<PRE>";
//                print_r($model->file);
//                die();
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
