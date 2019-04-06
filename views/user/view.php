<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User Profile';
\yii\web\YiiAsset::register($this);
?>

<h2 class="page-header">
    <?= $this->title; ?>
</h2>

<?php switch (yii::$app->user->identity->type) {
    case User::TYPE_ADMIN :
        echo $this->render('_admin', ['model' => $model]);
        break;
    case User::TYPE_USER :
        echo $this->render('_user', ['model' => $model]);
        break;
    case User::TYPE_COMPANY :
        echo $this->render('_company', ['model' => $model]);
        break;
} ?>
