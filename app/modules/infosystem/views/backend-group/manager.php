<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\infosystem\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Group and item'));
$this->setPageHeader(Module::t('Group and item'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<?= GridView::widget([
    'filterModel' => $data['searchModel'],
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'group' => [
                'url' => [
                    'create',
                    'infosystem_id' => $data['infosystem']->id,
                    'parent_id' => $data['id'],
                ],
            ],
            'item' => [
                'url' => [
                    'backend-item/create',
                    'infosystem_id' => $data['infosystem']->id,
                    'group_id' => $data['id'],
                ],
            ],
        ],
        'delete' => [
            'item' => [
                'url' => ['backend-item/selection-delete'],
            ],
            'group' => [
                'url' => ['backend-group/selection-delete'],
            ],
        ],
    ],
    'columns' => [
        [
            'class' => \yii\grid\CheckboxColumn::className(),
            'checkboxOptions' => function ($data) {
                return [
                    'value' => $data['id'],
                    'group' => array_key_exists('group_id', $data) ? false : true,
                ];
            }
        ],
        [
            'attribute' => 'name',
            'label' => Yii::t('app', 'Name'),
            'format' => 'raw',
            'value' => function ($data) {
                return array_key_exists('group_id', $data) ?
                    $data['name'] :
                    Html::a($data['name'], ['manager', 'infosystem_id' => $data['infosystem_id'], 'id' => $data['id']]);
            }
        ],
        [
            'attribute' => 'date',
            'label' => Yii::t('app', 'Date'),
            'headerOptions' => ['style' => 'width: 20%'],
            'format' => 'date',
            'filter' => \yii\jui\DatePicker::widget([
                'model' => $data['searchModel'],
                'attribute' => 'date',
                'options' => ['class' => 'form-control'],
            ]),
        ],
        [
            'attribute' => 'sorting',
            'label' => Yii::t('app', 'Sorting'),
            'headerOptions' => ['style' => 'width: 10%'],
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Item[sorting]',
                    'value' => $data['sorting'],
                    'formOptions' => ['action' => ['backend-item/edit-sorting', 'id' => $data['id']]],
                ]);
            }
        ],
        [
            'attribute' => 'id',
            'label' => Yii::t('app', 'ID'),
            'headerOptions' => ['style' => 'width: 5%'],
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'controller' => 'loop',
            'urlCreator' => function ($action, $model, $key, $index) {
                return array_key_exists('group_id', $model) ?
                    Url::to(["backend-item/{$action}", 'id' => $model['id']]) :
                    Url::to(["{$action}", 'id' => $model['id']]);
            }
        ]
    ],
]); ?>