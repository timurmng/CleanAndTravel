<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>

<div class="user-view">
    <div class="location-main-content">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fullname',
                'email:email',
                'phoneNumber'
            ],
        ]) ?>
    </div>

</div>
