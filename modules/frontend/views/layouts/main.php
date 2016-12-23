<?php

/* @var $this \app\core\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

\app\modules\frontend\views\assets\Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->getTitle(); ?></title>
    <meta name="description" content="<?= $this->getMetaDescription(); ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container wrapper">
    <div class="row">
        <div class="col-md-12">
            <?php NavBar::begin(); ?>
            <?= Nav::widget([
                'items' => [
                    [
                        'label' => Yii::t('user', 'Login menu item'),
                        'url' => ['/user/default/login'],
                        'visible' => Yii::$app->user->isGuest,
                        'linkOptions' => ['class' => 'show-in-modal'],
                    ],
                    [
                        'label' => Yii::t('user', 'Menu personal area'),
                        'url' => ['/user/default/personal'],
                        'visible' => !Yii::$app->user->isGuest,
                    ],
                    [
                        'label' => Yii::t('user', 'Logout'),
                        'url' => ['/user/default/logout'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('user', 'Registration'),
                        'url' => ['/user/default/registration'],
                        'visible' => Yii::$app->user->isGuest,
                        'linkOptions' => ['class' => 'show-in-modal'],
                    ],
                ],
                'options' => ['class' => 'pull-right navbar-nav'],
            ]); ?>
            <?php NavBar::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= \app\modules\shop\widgets\frontend\searchProduct\Widget::widget(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Nav::widget([
                'items' => [
                    ['label' => 'Информационные системы', 'url' => ['/informationsystem/manager/system']],
                ],
                'options' => ['class' => 'nav-pills'],
            ]); ?>
        </div>
    </div>
    <?= $content; ?>
</div>
<?= \app\core\widgets\showContentModal\widget::widget();?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
