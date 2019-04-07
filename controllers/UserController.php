<?php

namespace app\controllers;

use app\components\AccessRule;
use app\models\BadgesUser;
use app\models\Friends;
use app\models\Request;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'only' => ['index', 'create', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => [User::TYPE_ADMIN]
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [User::TYPE_COMPANY, User::TYPE_USER],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => false,
                        'roles' => ['@']
                    ]

                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                'model' => $model
            ]);
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => User::SCENARIO_CREATE]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model,]);
    }

    public function actionBadges()
    {
        $badges = yii::$app->user->identity->badges;

        return $this->render('badges', [
            'badges' => $badges
        ]);
    }

    public function actionFriends()
    {
        $friends = yii::$app->user->identity->friends;
        return $this->render('friends', [
            'friends' => $friends
        ]);
    }

    public function actionAddFriend()
    {
        $friend = new Friends();

        if (yii::$app->request->isPost) {

            $friendEmail = yii::$app->request->post('Friends')['friendEmail'];

            if ($friendEmail == yii::$app->user->identity->email) {
                yii::$app->session->setFlash('warning', 'Invalid email address');
                return $this->refresh();
            }

            $user = User::findOne(['email' => $friendEmail]);

            if (!$user) {
                yii::$app->session->setFlash('warning', 'Invalid email address');
                return $this->refresh();
            }

            $friend->idUser1 = yii::$app->user->id;
            $friend->idUser2 = $user->getId();

            if ($friend->save()) {
                yii::$app->session->setFlash('success', 'Friend successfully added!');
                return $this->redirect('/user/friends');
            }

        }
        return $this->render('add_friend', [
            'friend' => $friend
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
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
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRequest($id)
    {
        $request = new Request();
        $request->idUser = yii::$app->user->identity->getId();
        $request->locationId = $id;
        $request->status = Request::STATUS_PENDING;

        if ($request->save()) {
            yii::$app->session->setFlash('warning', 'Request sent');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    /**
     * @param $id
     * @return User|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
