<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;
use yii\helpers\HtmlPurifier;

$this->setTitle($data->getName());
$this->setMetaDescription($data->getMetaDescription());
$this->setPageHeader($data->getName());
$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $data->getId(),
    [
        'modelClass' => Group::className(),
        'enableRoot' => false,
        'urlOptions' => [
            'route' => '/shop/group/view',
            'queryGroupName' => 'id',
        ],
    ]
)); ?>

    <div class="panel panel-default">
        <div class="panel-heading">Описание группы</div>
        <div class="panel-body">
            <?= HtmlPurifier::process($data->getContent()); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Дочерние группы</div>
        <div class="panel-body">
            <?php foreach ($data->getSubGroups() as $group) : ?>
                <div class="img-thumbnail">
                    <?= $group->name; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?= $this->render('_listViewProduct', ['data' => $data]); ?>