<?php
use app\modules\backend\widgets\grid\GridView;
use app\modules\lists\Module;
use yii\helpers\Url;
use yii\helpers\Html;

$this->setPageHeader(Module::t('Items'));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    //'id' => 'test',
    'dataProvider' => $data['dataProvider'],
    'checkboxColumn' => true,
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create', 'list_id' => $data['listId']],
            ],
        ],
        'delete' => [
            'item' => [
                'url' => 'create',
                'linkOptions' => ['class' => 'selected-delete'],
            ],
        ],
    ],
    'columns' => [
        'value',
        'id',
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
]);
?>

<button id="press">press</button>
<script>
    $(function () {
        var button = $('.selected-delete');


        button.click(function () {
            var keys = $('.grid-view').yiiGridView('getSelectedRows');

            console.log(button.closest('.grid-view').yiiGridView('getSelectedRows'));

            return false;
/*
            $.ajax({
                type: 'POST',
                data: {'checkbox': keys},
                url: '/site/test',
                success: function (data) {
                 console.log(data);
                }
            });
            */
        });
      });
</script>