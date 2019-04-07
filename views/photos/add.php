<?php
/* @var $this yii\web\View */
/* @var $location \app\models\Location */

use app\models\Photo;

$this->title = 'Add photo to '. $location->locationName;
?>
<h2 class="page-header">
    <?= $this->title; ?>
</h2>

<?php $form = \yii\widgets\ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]); ?>

<div class="photo-form">
    <?= $form->field($model, 'file')->fileInput([
        'accept' => 'jpg, jpeg, bmp, png'
    ]); ?>

    <?= $form->field($model, 'type')->dropDownList([
        Photo::TYPE_BEFORE => 'Before Photo',
        Photo::TYPE_AFTER => 'After Photo'
    ], ['prompt' => 'Please select a type']);
    ?>

    <div class="form-group">
        <?php echo \yii\helpers\Html::submitButton($this->title . ' <span class="glyphicon glyphicon-upload"></span>',
            [
                'class' => 'btn btn-primary'
            ]); ?>
    </div>

    <?php \yii\widgets\ActiveForm::end(); ?>
</div>
