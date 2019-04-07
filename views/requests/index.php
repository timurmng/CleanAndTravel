<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $requests \app\models\Request */
?>

<?php \yii\widgets\Pjax::begin(); ?>

    <div class="request-index">
        <h2 class="page-header">Requests</h2>

        <?php foreach ($requests as $k => $request): ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $request[0],
                'attributes' => [
                    [
                        'attribute' => 'Organizer',
                        'value' => function ($model) {
                            return Html::button($model->user->fullname, [
                                'value' => \yii\helpers\Url::to('/user/view/' . $model->user->id),
                                'id' => 'modalButton'
                            ]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Location',
                        'value' => function ($model) {
                            return Html::a($model->location->locationName, 'locations/view/' . $model->location->id);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            switch ($model->status) {
                                case \app\models\Request::STATUS_PENDING:
                                    return 'Pending';
                                case \app\models\Request::STATUS_ACCEPTED:
                                    return 'Accepted';
                                case \app\models\Request::STATUS_DECLINED:
                                    return 'Declined';
                                case \app\models\Request::STATUS_FINALIZED:
                                    return 'Finalized';
                                case \app\models\Request::STATUS_ABSENT:
                                    return 'Absent';
                            }
                        }
                    ]
                ]
            ]); ?>
            <div class="form-group pull-right">
                <a href="/requests/accept/<?= $request[0]->id ?>" class="btn btn-default">Accept</a>
                <a href="/requests/decline/<?= $request[0]->id ?>" class="btn btn-danger">Decline</a>
                <a href="/requests/finalize/<?= $request[0]->id ?>" class="btn btn-success">Finalize</a>
                <a href="/requests/absence/<?= $request[0]->id; ?>" class="btn btn-warning">Set absent</a>
            </div>

        <?php endforeach; ?>
    </div>

<?php Modal::begin([
    'header' => '<h4>Detalii Organizator</h4>',
    'id' => 'modal',
    'class' => 'modal-lg'
]);

echo '<div id="modalContent"></div>';
Modal::end();
?>