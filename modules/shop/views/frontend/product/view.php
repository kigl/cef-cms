<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getTitle());
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

echo \yii\widgets\DetailView::widget([
    'model' => $data->getModel(),
    'attributes' => [
        [
            'label' => 'image',
            'format' => 'raw',
            'value' => \yii\helpers\Html::img($data->getMainImage()),
        ],
        'name',
        'price',
        [
            'attribute' => 'groupName',
            'value' => $data->getGroupName(),
        ],
        'description',
    ],
]);
?>

<?php
$test = [
    [
        'label' => 123,
        'value' => 'foo',
    ],
];
?>

<?= \yii\widgets\DetailView::widget([
        'model' => $test,
        'attributes' => ['123',],
]); ?>

<?php foreach ($data->getImages() as $images) : ?>

<img src="<?= $images->getFileUrl(); ?>" style="max-width: 100px;">

<?php endforeach; ?>