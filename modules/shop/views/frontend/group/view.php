<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getName());
$this->setMetaDescription($data->getMetaDescription());
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
));

$this->setPageHeader($data->getName());
?>

<?= $this->render('_listViewProduct', ['data' => $data]);?>