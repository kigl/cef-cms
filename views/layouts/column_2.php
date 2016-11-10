<?php
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\modules\main\widgets\backend\Alert;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php NavBar::begin(); ?>
            <?= Nav::widget([
                'items' => [
                    ['label' => Yii::t('user', 'Login'), 'url' => ['/user/default/login']],
                    ['label' => Yii::t('user', 'Registration'), 'url' => ['/user/default/registration']],
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
<? //= Alert::widget(); ?>
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
<?= $content; ?>
    </div>
    </div>
<?php $this->endContent(); ?>