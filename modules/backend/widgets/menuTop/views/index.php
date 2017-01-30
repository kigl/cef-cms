<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

?>

<?php
NavBar::begin([
    'options' => ['class' => 'navbar navbar-inverse no-border-radius'],
    'innerContainerOptions' => ['class' => 'container-fluid'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-cog"></i> Системные',
            'items' => [
                ['label' => 'Менеджер настроек', 'url' => ['/backend/setting/manager']],
            ],
        ],
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> ' . Html::encode(Yii::$app->user->identity->login),
            'url' => ['/backend/user/default/update', 'id' => Yii::$app->user->identity->id]
        ],
        ['label' => Yii::t('user', 'Logout'), 'url' => ['/user/default/logout']],
    ],
]);

NavBar::end()
?>