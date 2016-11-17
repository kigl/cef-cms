<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setBreadcrumbs(Breadcrumbs::getLinksGroup($parent_id, [
    'modelClass' => Group::className(),
    'urlOptions' => [
        'route' => '/admin/shop/group/manager',
        'queryGroupName' => 'parent_id',
    ],
]))?>
<?= $this->render('_form', ['model' => $model]);?>