<?php
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\modules\admin\widgets\Alert;

?>
<?php $this->beginContent('@app/modules/frontend/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php NavBar::begin(); ?>
            <?= Nav::widget([
                'items' => [
                    [
                        'label' => Yii::t('user', 'Login menu item'),
                        'url' => ['/user/default/login'],
                        'visible' => Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('user', 'Menu personal area'),
                        'url' => ['/user/default/personal', 'id' => Yii::$app->user->getId()],
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
                        'visible' => Yii::$app->user->isGuest
                    ],
                ],
                'options' => ['class' => 'pull-right navbar-nav'],
            ]); ?>
            <?php NavBar::end(); ?>
        </div>
    </div>
<?php echo Breadcrumbs::widget([
    'homeLink' => [
        'label' => 'Главная',
        'url' => ['/site/index'],
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'activeItemTemplate' => "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>",
]); ?>
<?= Alert::widget(); ?>
    <div>
        <?php
        if (isset($this->params['actionBar'])) {
            echo Menu::widget([
                'items' => $this->params['actionBar'],
                'options' => ['class' => 'list-inline'],
                'encodeLabels' => false,
                'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
            ]);
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= \app\modules\shop\widgets\frontend\treeGroup\Widget::widget();?>
        </div>
    </div>
<?= $content; ?>
    </>
    </div>
<?php $this->endContent(); ?>