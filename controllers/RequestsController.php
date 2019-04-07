<?php

namespace app\controllers;

use app\models\Location;
use Yii;
use app\models\Request;
use app\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestsController implements the CRUD actions for Request model.
 */
class RequestsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $locations = Location::findAll(['idUser' => yii::$app->user->getId()]);
        $requests = [];
        foreach ($locations as $location) {
            $requests[$location->id] = Request::findAll(['locationId' => $location->id]);
        }

        return $this->render('index', [
            'requests' => $requests,
        ]);
    }


    public function actionAccept($id)
    {
        $request = Request::findOne($id);
        $request->status = Request::STATUS_ACCEPTED;
        if ($request->save()) {
            yii::$app->session->setFlash('success', 'Request approved');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    public function actionDecline($id)
    {
        $request = Request::findOne($id);
        $request->status = Request::STATUS_DECLINED;
        if ($request->save()) {
            yii::$app->session->setFlash('danger', 'Request declined');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    public function actionFinalize($id)
    {
        $request = Request::findOne($id);
        $request->status = Request::STATUS_FINALIZED;
        if ($request->save()) {
            yii::$app->session->setFlash('danger', 'Request successfully finalized');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    public function actionAbsent($id)
    {
        $request = Request::findOne($id);
        $request->status = Request::STATUS_ABSENT;
        if ($request->save()) {
            yii::$app->session->setFlash('danger', 'User set to be absent');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
