<?php
use app\modules\form\Module;
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Html;

$this->setTitle(Module::t('Form fields'));
$this->setPageHeader(Module::t('Form fields'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'group' => [
                'url' => [
                    'create',
                    'form_id' => $data['get']['form_id'],
                    'parent_id' => !empty($data['get']['id']) ? $data['get']['id'] : null,
                ],
            ],
            'item' => [
                'url' => [
                    'backend-field/create',
                    'form_id' => $data['get']['form_id'],
                    'group_id' => !empty($data['get']['id']) ? $data['get']['id'] : null,
                ],
            ],
        ],
    ],
    'dataProviderGroup' => $data['dataProviderGroup'],
    'dataProvider' => $data['dataProvider'],
    'columnsGroup' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->name, ['manager', 'form_id' => $model->form_id, 'id' => $model->id]);
            }
        ],
        [
            'attribute' => 'sorting',
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Group[sorting]',
                    'value' => $data->sorting,
                    'formOptions' => ['action' => ['edit-sorting', 'id' => $data->id]],
                ]);
            }
        ],
        'id',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
        ]
    ],
    'columns' => [
        'name',
        [
            'attribute' => 'sorting',
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Field[sorting]',
                    'value' => $data->sorting,
                    'formOptions' => ['action' => ['backend-field/edit-sorting', 'id' => $data->id]],
                ]);
            }
        ],
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'controller' => 'backend-field',
            'template' => "{update} {delete}",
        ],
    ],
]); ?>
