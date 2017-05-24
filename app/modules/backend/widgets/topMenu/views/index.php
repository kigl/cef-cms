<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
?>

<?php
NavBar::begin([
    'options' => ['class' => 'navbar navbar-inverse'],
    'innerContainerOptions' => ['class' => 'container-fluid'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="fa fa-user"></i>&nbsp;' . Yii::$app->user->identity->login,
            'url' => ['/users/backend-user/update', 'id' => Yii::$app->user->id]
        ],
        ['label' => Yii::t('app', 'Logout'), 'url' => ['/users/user/logout']],
    ],
]);

NavBar::end()
?>