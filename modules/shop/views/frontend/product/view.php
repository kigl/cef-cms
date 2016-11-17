<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setBreadcrumbs(
    Breadcrumbs::getLinksGroup(
        $model->group_id,
        [
            'modelClass' => Group::className(),
            'enableQueryGroupAlias' => $this->getModule()->alias,
            'enableRoot' => false,
            'urlOptions' => [
                'route' => '/shop/group/view',
                'queryGroupName' => 'id',
            ],
        ]
    ));

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