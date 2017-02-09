<?php
use yii\helpers\ArrayHelper;
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;
/*
$breadcrumbsGroup = Breadcrumbs::getLinksGroup(
    $data->getGroupId(),
    [
        'modelClass' => Group::className(),
        'urlOptions' => [
            'route' => '/admin/shop/group/manager',
            'queryGroupName' => 'parent_id',
        ],
    ]);
$breadcrumbs = ArrayHelper::merge($breadcrumbsGroup, [
    ['label' => $data->getName()],
]);

$this->setBreadcrumbs($breadcrumbs);
*/
?>

<?= $this->render('_form', ['data' => $data]);?>

