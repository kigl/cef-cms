<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Products'));
$this->setPageHeader(Module::t('Products'));
$this->params['toolbar'] = $this->module->toolbar['group'];
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    //'filterModel' => $data['searchModel'],
    'filterPosition' => GridView::FILTER_POS_BODY,
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to(['create', 'parent_id' => $data['id']]),
            ],
            'item' => [
                'url' => Url::to(['backend-product/create', 'group_id' => $data['id']]),
            ],
        ],
        'delete' => [
            'item' => [
                'url' => ['backend-product/selection-delete'],
            ],
            'group' => [
                'url' => ['backend-group/selection-delete'],
            ],
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'label' => Yii::t('app', 'Name'),
            'format' => 'raw',
            'headerOptions' => ['style' => 'width: 50%'],
            'value' => function ($data) {
                return array_key_exists('parent_id', $data) ?
                    Html::a($data['name'], ['manager', 'id' => $data['id']]) :
                    $data['name'];
            }
        ],
        'price:currency',
        [
            'attribute' => 'create_time',
            'format' => 'date',
            'filter' => \yii\jui\DatePicker::widget([
                'model' => $data['searchModel'],
                'attribute' => 'create_time',
                'options' => ['class' => 'form-control'],
            ]),
        ],
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'backend-product/update',
                            'id' => $model['id']
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'backend-product/delete',
                        'id' => $model['id']
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ],
    ],
]); ?>
