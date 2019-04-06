<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSender')->textInput() ?>

    <?= $form->field($model, 'idReceiver')->textInput() ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
