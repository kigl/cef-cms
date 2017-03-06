<?php
use app\modules\backend\widgets\grid\GridView;
use app\modules\user\helpers\StatusRbacHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\rbac\Item;

$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Toolbar rbac')];

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['rbac/create']),
            ],
        ],
    ],
    'columns' => [
        [
            'label' => Yii::t('user', 'Rbac form name'),
            'value' => function ($data) {
                return $data->name;
            }
        ],
        [
            'label' => Yii::t('user', 'Rbac form type'),
            'value' => function ($data) {
                return StatusRbacHelper::getStatus($data->type);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'rbac/update',
                            'type' => $model->type,
                            'name' => $model->name,
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'rbac/delete',
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
