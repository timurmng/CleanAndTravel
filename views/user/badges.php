<?php

/* @var $badges app\models\Badge */

$this->title = 'Badges';
?>

<h2 class="page-header">
    <?= \yii\helpers\Html::encode($this->title); ?>
</h2>

<ul class="list-group">
    <?php foreach ($badges as $badge) : ?>
        <li class="list-group-item">
            <?= $badge->badge->badgesName; ?>
        </li>
    <?php endforeach; ?>
</ul>