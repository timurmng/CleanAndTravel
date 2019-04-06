<?php
/* @var $friends \app\models\Friends */
$this->title = 'Friends'; ?>

<h2 class="page-header">
    <?= $this->title; ?>
    <div class="pull-right">
        <a href="/user/add-friend" class="btn btn-default">Add a friend</a>
    </div>
</h2>

<div class="friend-list">
    <?php foreach ($friends as $friend) : ?>
        <a href="/user/view/<?= $friend->user2->id; ?>">
            <?= $friend->user2->fullname; ?>
        </a>
    <?php endforeach; ?>
</div>

