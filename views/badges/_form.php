<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Badge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="badge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'badgesName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
