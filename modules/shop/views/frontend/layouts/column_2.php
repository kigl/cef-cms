<?php
use yii\widgets\Menu;
use app\core\widgets\pageHeader\Widget as PageHeader;
use app\modules\frontend\widgets\Breadcrumbs;
use app\modules\admin\widgets\Alert;

?>
<?php $this->beginContent('@app/modules/frontend/views/layouts/main.php'); ?>
    <div calss="row">
        <div class="col-md-3">
           <?= \app\modules\shop\widgets\frontend\treeGroup\Widget::widget(['options' => ['class' => 'tree-group']]);?>
        </div>
        <div class="col-md-9">
            <?= Breadcrumbs::widget(['enableModuleItem' => false]); ?>
            <?= Alert::widget(); ?>
            <?= PageHeader::widget();?>
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