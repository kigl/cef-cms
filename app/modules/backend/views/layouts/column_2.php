<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use app\modules\backend\widgets\Breadcrumbs;
use app\core\widgets\Alert;
use app\modules\backend\widgets\Menu as MenuSidebar;
use app\modules\backend\widgets\menuTop\Widget as MenuTop;

?>

<?php $this->beginContent('@app/modules/backend/views/layouts/index.php'); ?>
    <header class="main-header">
            <span class="logo">
            </span>
        <nav class="navbar navbar-static-top">
            <div class="navbar-custom-menu">
                <?= MenuTop::widget(); ?>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?= MenuSidebar::widget([
                'options' => ['class' => 'sidebar-menu'],
                'itemOptions' => ['class' => 'treeview'],
                'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
            ]); ?>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <?php
            echo Breadcrumbs::widget([
                'options' => ['class' => 'breadcrumb'],
                'homeLink' => [
                    'label' => Yii::t('yii', 'Home'),
                    'url' => '/backend'
                ],
                'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
            ]); ?>

            <h1>
                <?= Html::encode($this->getPageHeader()); ?>
            </h1>

            <?= Menu::widget([
                'options' => ['class' => 'list-inline toolbar margin-top-10'],
                'encodeLabels' => false,
                'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
                'items' => isset($this->params['toolbar']) ? $this->params['toolbar'] : [],
            ]); ?>

        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?= Alert::widget(); ?>
                </div>
            </div>
            <?= $content; ?>
        </section>

    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All
        rights
        reserved.
    </footer>
<?php $this->endContent(); ?>