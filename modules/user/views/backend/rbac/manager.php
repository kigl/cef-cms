<?php
use app\modules\admin\widgets\grid\GridView;
use app\modules\user\helpers\StatusRbacHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\rbac\Item;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#role" data-toggle="tab">Роли</a></li>
    <li><a href="#permission" data-toggle="tab">Разрешения</a></li>
</ul>

<div class="tab-content">
    <div class="margin-top-10"></div>
    <div class="tab-pane active" id="role">
        <?= GridView::widget([
            'dataProvider' => $roleDataProvider,
            'buttons' => [
                'create' => [
                    'item' => [
                        'url' => Url::to(['rbac/create', 'type' => Item::TYPE_ROLE]),
                    ],
                ],
            ],
            'columns' => [
                'name',
                [
                    'attribute' => 'type',
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
                                    'name' => $model->name
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                                'rbac/delete',
                                'name' => $model->name
                            ],
                                ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                            );
                        }
                    ],
                ]
            ],
        ]) ?>
    </div>
    <div class="tab-pane" id="permission">
        <?= GridView::widget([
            'dataProvider' => $permissionDataProvider,
            'buttons' => [
                'create' => [
                    'item' => [
                        'url' => Url::to(['rbac/create', 'type' => Item::TYPE_PERMISSION]),
                    ],
                ],
            ],
            'columns' => [
                'name',
                [
                    'attribute' => 'type',
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
                                    'name' => $model->name
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                                'rbac/delete',
                                'name' => $model->name
                            ],
                                ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                            );
                        }
                    ],
                ]
            ],
        ]) ?>
    </div>
</div>
