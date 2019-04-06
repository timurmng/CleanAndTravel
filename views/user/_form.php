<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        User::TYPE_COMPANY => 'Company/ONG',
        User::TYPE_USER => 'Volunteer'
    ], [
        'prompt' => 'Please select a type'
    ]) ?>

    <?= $form->field($model, 'phoneNumber')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
