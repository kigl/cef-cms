<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use app\modules\backend\widgets\Breadcrumbs;
use app\core\widgets\Alert;
use app\modules\backend\widgets\Menu as MenuSidebar;
use app\modules\backend\widgets\topMenu\Widget as MenuTop;

?>

<?php $this->beginContent('@app/modules/backend/views/layouts/index.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <nav class="header__navbar">
                        <?= MenuTop::widget(); ?>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <?= MenuSidebar::widget([
                        'options' => ['class' => 'sidebar-menu list-group'],
                        'itemOptions' => ['class' => 'sidebar-menu__item list-group-item'],
                        'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
                    ]); ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="content-bar">
                    <?= Breadcrumbs::widget([
                        'options' => ['class' => 'content-bar__breadcrumb breadcrumb'],
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Home'),
                            'url' => '/backend'
                        ],
                        'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                    ]); ?>

                    <div class="content-bar__header h3">
                        <?= Html::encode($this->getPageHeader()); ?>
                    </div>

                    <?= Menu::widget([
                        'options' => ['class' => 'content-bar__toolbar list-inline margin-top-10'],
                        'encodeLabels' => false,
                        'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
                        'items' => isset($this->params['toolbar']) ? $this->params['toolbar'] : [],
                    ]); ?>

                    <?= Alert::widget(); ?>

                    <div class="content">
                        <?= $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>