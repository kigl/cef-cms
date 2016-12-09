<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getName());
$this->setMetaDescription($data->getMetaDescription());
$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $data->getId(),
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

$this->setPageHeader($data->getName());
?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $data->getDataProviderProducts(),
    'itemView' => '_product',
    //'summary' => "{count} " . Yii::t('app', 'List view summary text: is') . " {totalCount}",
    'summaryOptions' => [
        'class' => 'text-right'
    ],
]);
?>