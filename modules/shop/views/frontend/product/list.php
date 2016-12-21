<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($dataGroup->getName());
$this->setMetaDescription($dataGroup->getMetaDescription());
/*$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $dataGroup->getId(),
    [
        'modelClass' => Group::className(),
        'enableQueryGroupAlias' => $this->getModule()->urlAlias,
        'enableRoot' => false,
        'urlOptions' => [
            'route' => '/shop/group/view',
            'queryGroupName' => 'id',
        ],
    ]
));*/

$this->setPageHeader($dataGroup->getName());

$this->registerJsFile('@web/modules/shop/views/frontend/js/addToCart.js', ['position' => \yii\web\View::POS_BEGIN]);

echo $this->render('_listView', ['data' => $dataProduct]);