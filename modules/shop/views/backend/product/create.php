<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setBreadcrumbs(Breadcrumbs::getLinksGroup($data->getGroupId(), [
    'modelClass' => Group::className(),
    'urlOptions' => [
        'route' => '/admin/shop/group/manager',
        'queryGroupName' => 'parent_id',
    ],
]))?>

<?= $this->render('_form', ['data' => $data]);?>