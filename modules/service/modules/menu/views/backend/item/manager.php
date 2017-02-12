    <?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to([
                    'create',
                    'menu_id' => $data['menuId'],
                    'parent_id' => $data['parentId'],
                ]),
            ],
        ]
    ],

    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(
                    Html::encode($data->name),
                    ['item/manager', 'menu_id' => $data->menu_id, 'parent_id' => $data->id]
                );
            }
        ],
        [
            'attribute' => 'visible',
            'value' => function ($data) {
                return $data->getStatusVisible($data->visible);
            }
        ],
        [
            'attribute' => 'sorting',
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Item[sorting]',
                    'value' => $data->sorting,
                    'formOptions' => ['action' => ['edit-sorting', 'id' => $data->id]],
                ]);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ],
    ],
]); ?>
