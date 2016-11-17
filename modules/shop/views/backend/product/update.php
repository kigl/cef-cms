<?php
use yii\helpers\ArrayHelper;
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$breadcrumbsGroup = Breadcrumbs::getLinksGroup(
    $model->group_id,
    [
        'modelClass' => Group::className(),
        'urlOptions' => [
            'route' => '/admin/shop/group/manager',
            'queryGroupName' => 'parent_id',
        ],
    ]);
$breadcrumbs = ArrayHelper::merge($breadcrumbsGroup, [
    ['label' => $model->name],
]);

$this->setBreadcrumbs($breadcrumbs);?>


<?= $this->render('_form', [
    'model' => $model,
    'property' => $property,
    'modification' => $modification,
    'images' => $images,
]);?>