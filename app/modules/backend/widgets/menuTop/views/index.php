<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
?>

<?php
NavBar::begin([
    'options' => ['class' => 'navbar navbar-inverse no-border-radius bg-theme no-border no-margin'],
    'innerContainerOptions' => ['class' => 'container-fluid'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="fa fa-user"></i>&nbsp;' . Yii::$app->user->identity->login,
            'url' => ['/user/backend-user/update', 'id' => Yii::$app->user->id]
        ],
        ['label' => Yii::t('app', 'Logout'), 'url' => ['/user/user/logout']],
    ],
]);

NavBar::end()
?>