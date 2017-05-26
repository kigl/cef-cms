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
    'filterModel' => $data['searchModel'],
    'filterPosition' => GridView::FILTER_POS_BODY,
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to(['create', 'shop_id' => $data['get']['shop_id'], 'parent_id' => $data['id']]),
            ],
            'item' => [
                'url' => Url::to([
                    'backend-product/create',
                    'shop_id' => $data['get']['shop_id'],
                    'group_id' => $data['id']
                ]),
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
            'class' => \yii\grid\CheckboxColumn::className(),
            'headerOptions' => ['style' => 'width: 3%'],
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
            'headerOptions' => ['style' => 'width: 45%'],
            'value' => function ($data) {
                return array_key_exists('group_id', $data) ?
                    $data['name'] :
                    Html::a($data['name'], ['manager', 'id' => $data['id'], 'shop_id' => $data['shop_id']]);
            }
        ],
        [
            'attribute' => 'active',
            'label' => Yii::t('app', 'Active'),
            'format' => 'raw',
            'value' => function ($data) {
                    return Html::checkbox('Active', $data['active'], ['disabled' => 'disabled']);
            }
        ],
        [
            'attribute' => 'price',
            'label' => Yii::t('app', 'Price'),
            'format' => 'currency',
            'headerOptions' => ['style' => 'width: 15%'],
        ],
        [
            'attribute' => 'create_time',
            'label' => Yii::t('app', 'Create time'),
            'format' => 'date',
            'headerOptions' => ['style' => 'width: 15%'],
            'filter' => \yii\jui\DatePicker::widget([
                'model' => $data['searchModel'],
                'attribute' => 'create_time',
                'options' => ['class' => 'form-control'],
            ]),
        ],
        [
            'attribute' => 'id',
            'label' => Yii::t('app', 'ID'),
            'headerOptions' => ['style' => 'width: 5%'],
        ],
        [
            'headerOptions' => ['style' => 'width: 5%'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'urlCreator' => function ($action, $model, $key, $index) {
                return array_key_exists('parent_id', $model) && array_key_exists('group_id', $model) ?
                    Url::to(["backend-product/" . $action, 'id' => $model['id']]) :
                    Url::to(["{$action}", 'id' => $model['id']]);
            }
        ],
    ],
]); ?>
