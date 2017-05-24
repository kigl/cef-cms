<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\forms\Module;
use app\modules\backend\widgets\grid\GridView;
use app\modules\forms\models\Field;

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
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        [
            'attribute' => 'name',
            'label' => Yii::t('app', 'Name'),
            'format' => 'raw',
            'value' => function ($data) {
                return array_key_exists('parent_id', $data) ?
                    Html::a($data['name'], ['manager', 'id' => $data['id'], 'form_id' => $data['form_id']]) :
                    $data['name'];
            },
        ],
        [
            'attribute' => 'required',
            'label' => Yii::t('app', 'Required'),
            'format' => 'raw',
            'value' => function ($data) {
                return array_key_exists('required', $data) ?
                    Html::checkbox('required', $data['required'], ['disabled' => 'disabled']) :
                    null;
            },
        ],
        [
            'attribute' => 'type',
            'label' => Yii::t('app', 'Field type'),
            'value' => function ($data) {
                return array_key_exists('type', $data) ? Field::getNameFieldType($data['type']) : null;
            }
        ],
        [
            'attribute' => 'sorting',
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Field[sorting]',
                    'value' => $data['sorting'],
                    'formOptions' => ['action' => ['backend-field/edit-sorting', 'id' => $data['id']]],
                ]);
            }
        ],
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'controller' => 'backend-field',
            'template' => "{update} {delete}",
            'urlCreator' => function ($action, $model, $key, $index) {
                return array_key_exists('group_id', $model) ?
                    Url::to(["backend-field/{$action}", 'id' => $model['id']]) :
                    Url::to(["backend-group/{$action}", 'id' => $model['id']]);
            }
        ],
    ],
]); ?>
