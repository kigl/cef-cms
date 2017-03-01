<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'model_class',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function ($model) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Comment[status]',
                    'value' => $model->status,
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $model->getAllStatus(),
                    'displayValueConfig' => $model->getAllStatus(),
                    'formOptions' => ['action' => ['edit-status', 'id' => $model->id]],
                ]);
            }
        ],
        'user_id',
        'content',
        'create_time:dateTime',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', [
                        'view',
                        'id' => $model->id
                    ],
                        ['class' => 'show-in-modal']
                    );
                },
            ],
        ]
    ],
]);?>
