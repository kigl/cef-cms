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
        <div class="col-md-2 sidebar">
            <?= MenuSidebar::widget(); ?>
        </div>
        <div class="col-md-10 blackboard">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">

                                <?= \app\core\widgets\Breadcrumbs::widget([
                                    'options' => ['class' => 'breadcrumb no-margin-bottom'],
                                    'homeLink' => [
                                        'label' => Yii::t('yii', 'Home'),
                                        'url' => ['/backend/default/index']
                                    ],
                                    'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                                ]); ?>

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

                                <?= app\core\widgets\pageHeader\Widget::widget([
                                    'text' => $this->getPageHeader(),
                                    'options' => ['class' => 'margin-top-10'],
                                ]); ?>

                                <?= \app\modules\backend\widgets\toolbar\Widget::widget([
                                    'options' => ['class' => 'list-inline well well-sm'],
                                ]); ?>
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