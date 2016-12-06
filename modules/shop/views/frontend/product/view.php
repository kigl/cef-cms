<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($model->getTitle());
$this->setBreadcrumbs(
    \yii\helpers\ArrayHelper::merge(
        Breadcrumbs::getLinksGroup(
            $model->group_id,
            [
                'modelClass' => Group::className(),
                'enableQueryGroupAlias' => $this->getModule()->urlAlias,
                'enableRoot' => false,
                'urlOptions' => [
                    'route' => '/shop/group/view',
                    'queryGroupName' => 'id',
                ],
            ]
        ), ['label' => $model->name]));

echo \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'price',
        [
            'attribute' => 'groupName',
            'value' => $model->group->name,
        ],
        'description',
    ],
]);