<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Location */
/* @var $isAjax boolean */
/* @var $status boolean */
yii::$app->session->set('last_location', $model->id);

$home = new LatLng(['lat' => 44.445322, 'lng' => 26.050064]);
$destination = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);

$directionsRequest = new DirectionsRequest([
    'origin' => $home,
    'destination' => $destination,
    'travelMode' => TravelMode::DRIVING
]);

$polylineOptions = new PolylineOptions([
    'strokeColor' => '#FFAA00',
    'draggable' => true
]);

$map = new Map([
    'center' => $destination,
    'zoom' => 10,
]);

$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

$directionsService = new DirectionsService([
    'directionsRenderer' => $directionsRenderer,
    'directionsRequest' => $directionsRequest
]);

$map->appendScript($directionsService->getJs());

//$marker = new Marker([
//    'position' => $destination,
//    'title' => $model->locationName
//]);
//
//$marker->attachInfoWindow(
//    new InfoWindow([
//        'content' => '<p>' . $model->details . '</p>'
//    ])
//);
//
//
//$map->addOverlay($marker);

$this->title = $model->locationName;
\yii\web\YiiAsset::register($this);

?>
<?php \yii\widgets\Pjax::begin(); ?>
<div class="location-view">

    <?php if (!$isAjax) : ?>
        <div class="col-md-6">
            <?= $map->display() ?>
        </div>
    <?php endif; ?>
    <div class="col-md-6">
        <h1 class="page-header">
            <?= Html::encode($this->title) ?>
            <?php if ($status) : ?>
                <div class="pull-right">
                    <a href="/user/request/<?= $model->id; ?>" class="btn btn-default">Request to join</a>
                </div>
            <?php endif; ?>
        </h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'details',
                    'label' => 'Details'
                ],
                [
                    'attribute' => 'organizator',
                    'label' => 'Organizator',
                    'value' => function ($model) {
                        return Html::button($model->user->fullname, [
                            'value' => \yii\helpers\Url::to('/user/view/' . $model->user->id),
                            'id' => 'modalButton',
                        ]);
                    },
                    'format' => 'raw'
                ]
            ]
        ]); ?>

        <?php if ($model->photos) : ?>
            <div class="photos-inline">
                <?php foreach ($model->photos as $photo) : ?>
                    <img src="../../<?= 'uploads/' . $model->id . '/' . substr($photo->photoPath, strrpos($photo->photoPath, '/') + 1) ?>"
                         alt="" height="260">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="div-footer pull-right">
            <a href="/photos/add/" class="btn btn-primary">Add photos</a>
        </div>
    </div>


</div>

<?php
Modal::begin([
    'header' => '<h4>Detalii Organizator</h4>',
    'id' => 'modal',
    'class' => 'modal-lg'
]);

echo '<div id="modalContent"></div>';
Modal::end();
?>

