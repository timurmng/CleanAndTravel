<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = 'Register';
?>

<div class="user-create">

    <h2 class="page-header">
        <?= Html::encode($this->title) ?>
    </h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
