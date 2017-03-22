<?php
use yii\widgets\Menu;

\kigl\cef\module\backend\widgets\menuSidebar\assets\Asset::register($this);
?>

    <script>$(function () {
            $('#sidebar-menu').tree();
        });</script>

<?php
echo Menu::widget([
    'options' => ['id' => 'sidebar-menu'],
    'items' => [
        [
            'label' => Yii::t('app', 'Menu item content'),
            'url' => '#',
            'items' => [
                [
                    'label' => '<i class="fa fa-comments"></i>&nbsp;' . Yii::t('comment', 'Module name'),
                    'url' => ['/backend/comment'],
                    'active' => Yii::$app->controller->module->id == 'comment',
                ],
                [
                    'label' => '<i class="fa fa-info-circle"></i>&nbsp;' . Yii::t('infosystem', 'Module name'),
                    'url' => ['/backend/infosystem'],
                    'active' => Yii::$app->controller->module->id == 'infosystem',
                ],
                [
                    'label' => '<i class="fa fa-file-text"></i>&nbsp;' . Yii::t('page', 'Module name'),
                    'url' => ['/backend/page'],
                    'active' => Yii::$app->controller->module->id == 'page',
                ],
                [
                    'label' => '<i class="fa fa-shopping-cart"></i>&nbsp;' . Yii::t('shop', 'Module name'),
                    'url' => ['/backend/shop'],
                    'active' => Yii::$app->controller->module->id == 'shop',
                ],
                [
                    'label' => '<i class="fa fa-tags"></i>&nbsp;' . Yii::t('tag', 'Module name'),
                    'url' => ['/backend/tag'],
                    'active' => Yii::$app->controller->module->id == 'tag',
                ],
            ]
        ],
        ['label' => Yii::t('app', 'Menu item service'), 'url' => '#', 'items' => [
            [
                'label' => '<i class="fa fa-cubes"></i>&nbsp;' . Yii::t('service', 'Module name'),
                'url' => ['/backend/service/default/index'],
                'active' => Yii::$app->controller->module->id == 'service',
            ],
        ]],
        ['label' => 'Пользователи', 'url' => '#', 'items' => [
            [
                'label' => '<i class="fa fa-user"></i>&nbsp;' . Yii::t('user', 'Module name'),
                'url' => ['/backend/user'],
                'active' => Yii::$app->controller->module->id == 'user',
            ],
        ]],
    ],
    'encodeLabels' => false,
    'activateParents' => true,
]);
?>