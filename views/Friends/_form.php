<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Friends */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="friends-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser1')->textInput() ?>

    <?= $form->field($model, 'idUser2')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
