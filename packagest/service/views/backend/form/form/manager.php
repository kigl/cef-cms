<?php
use kigl\cef\module\service\Module;
use kigl\cef\module\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->setTitle(Module::t('Forms'));
$this->setPageHeader(Module::t('Forms'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Forms')];

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), ['form/completed/manager', 'form_id' => $data->id]);
            }
        ],
        [
            'label' => null,
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Yii::t('app', 'Fields'), ['form/field/manager', 'form_id' => $data->id]);
            }
        ],
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
]); ?>
