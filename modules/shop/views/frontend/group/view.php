<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $model->id,
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

$this->setPageHeader("Группа - $model->name");
?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_product',
]);

?>


