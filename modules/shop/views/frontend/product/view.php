<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getName());
$this->setBreadcrumbs(
    \yii\helpers\ArrayHelper::merge(
        Breadcrumbs::getLinksGroup(
            $data->getGroupId(),
            [
                'modelClass' => Group::className(),
                'enableQueryGroupAlias' => $this->getModule()->urlAlias,
                'enableRoot' => false,
                'urlOptions' => [
                    'route' => '/shop/group/view',
                    'queryGroupName' => 'id',
                ],
            ]
        ), ['label' => $data->getName()]));

$this->setPageHeader($data->getName());

echo \yii\widgets\DetailView::widget([
    'model' => $data->getModel(),
    'attributes' => [
        'name',
        'price',
        [
            'attribute' => 'groupName',
            'value' => $data->getGroupName(),
        ],
        'description',
    ],
]);