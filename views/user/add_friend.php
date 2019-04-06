<?php
/* @var $friend \app\models\Friends */
$this->title = 'Add a friend';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<h2 class="page-header">
    <?= $this->title; ?>
</h2>

<?php $form = ActiveForm::begin(); ?>

<div class="add-friend col-md-5">

    <?= $form->field($friend, 'friendEmail'); ?>

    <div class="form-group">
        <?= Html::submitButton('Add friend', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
