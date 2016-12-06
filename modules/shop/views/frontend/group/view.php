<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($group->name);
$this->setMetaDescription($group->meta_description);
$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $group->id,
    [
        'modelClass' => Group::className(),
        'enableQueryGroupAlias' => $this->getModule()->urlAlias,
        'enableRoot' => false,
        'urlOptions' => [
            'route' => '/shop/group/view',
            'queryGroupName' => 'id',
        ],
    ]
));

$this->setPageHeader("Группа - $group->name");
?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProviderProduct,
    'itemView' => '_product',
]);
?>