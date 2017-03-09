<?php
use yii\helpers\Url;
use app\modules\user\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('User properties'));
$this->setPageHeader(Module::t('User properties'));
$this->params['breadcrumbs'][] = ['label' => Module::t('User properties')];
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
        ]
    ],
]);?>
