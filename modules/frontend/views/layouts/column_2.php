<?php
use yii\widgets\Menu;
use app\modules\admin\widgets\Alert;
use app\core\widgets\pageHeader\Widget as PageHeader;

?>

<?php $this->beginContent('@app/modules/frontend/views/layouts/main.php'); ?>
    <div calss="row">
        <div class="col-md-3">
            <?= \app\modules\shop\widgets\frontend\treeGroup\Widget::widget([
                'options' => [
                    'class' => 'tree-group nav nav-pills nav-stacked',
                ],
                'groupId' => isset($this->params['groupId']) ? $this->params['groupId'] : null,
            ]); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Хлебные крошки</div>
                <div class="panel-body">
                    <?= \app\modules\frontend\widgets\Breadcrumbs::widget(['enableModuleItem' => false]); ?>
                </div>
            </div>
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
            <div class="panel panel-default">
                <div class="panel-heading">Заголовок страницы</div>
                <div class="panel-body">
                    <?= PageHeader::widget(['text' => $this->getPageHeader()]); ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Контент страницы</div>
                <div class="panel-body">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>