<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:08
 */

use yii\helpers\Url;
use yii\helpers\Html;

echo \app\modules\admin\widgets\grid\GridView::widget([
    'dataProvider' => $data->getFieldDataProvider(),
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['/admin/shop/order/field-create']),
            ],
        ],
    ],
    'columns' => [
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'order/field-update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'order/field-delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ],
    ],
]);