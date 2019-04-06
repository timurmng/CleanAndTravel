<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>

<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullname',
            'email:email',
            'phoneNumber'
        ],
    ]) ?>

</div>
