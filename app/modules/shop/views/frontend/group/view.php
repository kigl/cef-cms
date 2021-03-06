<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\ProductGroup;
use yii\helpers\HtmlPurifier;

$this->setTitle($data['model']->name);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
?>

    <div class="panel panel-default">
        <div class="panel-heading">Описание группы</div>
        <div class="panel-body">
            <?= HtmlPurifier::process($data['model']->content); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Дочерние группы</div>
        <div class="panel-body">
            <?php foreach ($data['subGroups'] as $group) : ?>
                <div class="img-thumbnail">
                    <?= $group->name; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?= $this->render('_listViewProduct', ['data' => $data]); ?>
