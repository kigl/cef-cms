<?php
use yii\widgets\Menu;
use yii\helpers\Html;
use app\core\widgets\Alert;
use app\core\widgets\pageHeader\Widget as PageHeader;

?>

<?php $this->beginContent('@app/templates/flat/layouts/main.php'); ?>
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

            <div class="panel panel-default">
                <div class="panel-heading">Заголовок страницы</div>
                <div class="panel-body">
                    <?= PageHeader::widget(['text' => Html::encode($this->getPageHeader())]); ?>
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