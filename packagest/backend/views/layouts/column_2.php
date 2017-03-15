<?php
use yii\widgets\Menu;
use kigl\cef\module\backend\widgets\Breadcrumbs;
use kigl\cef\core\widgets\Alert;
use kigl\cef\module\backend\widgets\menuSidebar\Widget as MenuSidebar;
use kigl\cef\module\backend\widgets\menuTop\Widget as MenuTop;

?>
<?php $this->beginContent('@kigl/cef/module/backend/views/layouts/index.php'); ?>
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

                                <?php
                                /* echo \app\modules\backend\Breadcrumbs::widget([
                                    'options' => ['class' => 'breadcrumb'],
                                    'homeLink' => [
                                        'label' => Yii::t('yii', 'Home'),
                                        'url' => ['/backend/default/index']
                                    ],
                                    'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                                ]); */?>

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

                                <?= kigl\cef\core\widgets\pageHeader\Widget::widget([
                                    'text' => $this->getPageHeader(),
                                    'options' => ['class' => 'margin-top-10'],
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