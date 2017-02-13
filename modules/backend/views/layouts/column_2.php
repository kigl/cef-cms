<?php
use yii\widgets\Menu;
use app\modules\backend\widgets\Breadcrumbs;
use app\core\widgets\Alert;
use app\modules\backend\widgets\menuSidebar\Widget as MenuSidebar;
use app\modules\backend\widgets\menuTop\Widget as MenuTop;

?>
<?php $this->beginContent('@app/modules/backend/views/layouts/index.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="top">
                        <?= MenuTop::widget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row height-all">
        <div class="col-md-2 sidebar padding-left-5 height-all bg-theme">
            <?= MenuSidebar::widget(); ?>
        </div>
        <div class="col-md-10 blackboard">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">

                                <?= \app\modules\frontend\widgets\Breadcrumbs::widget(['enableModuleItem' => false]); ?>

                                <?php
                                /* echo Breadcrumbs::widget([
                                    'homeLink' => [
                                        'label' => 'Главная',
                                        'url' => ['/admin/default/index'],
                                    ],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    'activeItemTemplate' => "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>",
                                ]);*/
                                ?>
                                <?= Alert::widget(); ?>
                                <?php if (isset($this->params['pageHeader'])) : ?>
                                    <div class="page-header">
                                        <h3><?php echo $this->params['pageHeader']; ?></h3>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                if (isset($this->params['toolbar'])) {
                                    echo Menu::widget([
                                        'options' => ['class' => 'list-inline well well-sm'],
                                        'encodeLabels' => false,
                                        'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
                                        'items' => $this->params['toolbar'],
                                    ]);
                                }
                                ?>
                            </div>
                        </div>
                        <?= $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 padding-top-50"></div>
    </div>
<?php $this->endContent(); ?>