<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kigl\cef\module\shop\Module;
use kigl\cef\module\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Products'));
$this->setPageHeader(Module::t('Products'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= GridView::widget([
    'dataProviderGroup' => $data['dataProviderGroup'],
    'dataProvider' => $data['dataProviderProduct'],
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to(['create', 'parent_id' => $data['id']]),
            ],
            'item' => [
                'url' => Url::to(['product/create', 'group_id' => $data['id']]),
            ],
        ],
    ],
    'columnsGroup' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), ['manager', 'id' => $data->id]);
            }
        ],
        [],
        'create_time:date',
        'id',
        [
            'class' => \kartik\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'headerOptions' => ['style' => 'width: 50%'],
        ],
        'price:currency',
        'create_time:date',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \kartik\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'product/update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'product/delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ],
    ],
]);?>
