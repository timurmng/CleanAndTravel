<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;


/* @var $this yii\web\View */
/* @var $model app\models\Location */
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

<div class="location-view">

    <div class="col-md-6">
        <?= $map->display() ?>
    </div>

    <div class="col-md-6">
        <h1 class="page-header">
            <?= Html::encode($this->title) ?>
        </h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'details',
                    'label' => 'Detalii'
                ]
            ]
        ]); ?>
    </div>
</div>

