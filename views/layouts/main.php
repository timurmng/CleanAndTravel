<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Register',
                'url' => ['/user/create'],
                'visible' => yii::$app->user->isGuest
            ],
            [
                'label' => 'Home',
                'url' => ['/site/index'],
            ],
            [
                'label' => 'Requests',
                'url' => ['/requests/index'],
                'visible' => !yii::$app->user->isGuest && yii::$app->user->identity->type == \app\models\User::TYPE_COMPANY ? true : false
            ],
            [
                'label' => 'Locations',
                'url' => ['/locations/index'],
                'visible' => !yii::$app->user->isGuest
            ],
            [
                'visible' => !yii::$app->user->isGuest,
                'label' => yii::$app->user->isGuest ? '' : yii::$app->user->identity->fullname,
                'items' => [
                    [
                        'label' => 'Profile',
                        'url' => ['/user/view/' . yii::$app->user->getId()],
                    ],
                    [
                        'label' => 'Friends',
                        'url' => ['/user/friends']
                    ],
                    [
                        'label' => 'Badges',
                        'url' => ['/user/badges'],
                    ]

                ]
            ],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <a href="/site/contact">Contact</a>
        </p>

        <p class="pull-right">&copy; Clean and Travel <?= date('Y') ?></p>
    </div>
</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
