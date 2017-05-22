<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\users\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('RBAC'));
$this->setPageHeader(Module::t('RBAC'));
$this->params['breadcrumbs'][] = ['label' => Module::t('RBAC')];
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['backend-rbac/create']),
            ],
        ],
    ],
    'columns' => [
        [
            'label' => Yii::t('users', 'Rbac form name'),
            'value' => function ($data) {
                return $data->name;
            }
        ],
        [
            'label' => Yii::t('users', 'Rbac form type'),
            'value' => function ($data) {
                /**
                 * @todo
                 * вынести в класс
                 */
                return $data->type == \yii\rbac\Role::TYPE_ROLE ? Yii::t('app', 'Type role') : Yii::t('app', 'Type permission');
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'backend-rbac/update',
                            'type' => $model->type,
                            'name' => $model->name,
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'backend-rbac/delete',
                        'type' => $model->type,
                        'name' => $model->name
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ]
    ],
]) ?>
