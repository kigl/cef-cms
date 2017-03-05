<?php
use yii\widgets\Menu;

\app\modules\backend\widgets\menuSidebar\assets\Asset::register($this);
?>

    <script>$(function () {
            $('#sidebar-menu').tree();
        });</script>

<?php
echo Menu::widget([
    'options' => ['id' => 'sidebar-menu'],
    'items' => [
        ['label' => Yii::t('app', 'Menu item content'), 'url' => '#', 'items' => $data['content']],
        ['label' => Yii::t('app', 'Menu item service'), 'url' => '#', 'items' => $data['service']],
        ['label' => 'Пользователи', 'url' => '#', 'items' => $data['other']],
    ],
    'encodeLabels' => false,
    'activateParents' => true,
]);
?>