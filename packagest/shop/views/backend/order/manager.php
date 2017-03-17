<?php
use kigl\cef\module\shop\Module;
use kigl\cef\module\backend\widgets\grid\GridView;
use yii\helpers\Html;

$this->setTitle(Module::t('Orders'));
$this->setPageHeader(Module::t('Orders'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Orders')];
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'create_time:date',
        [
            'attribute' => 'user.surname',
            'value' => function ($data) {
                return $data->user->surname;
            }
        ],
        [
            'attribute' => 'user.name',
            'value' => function ($data) {
                return $data->user->name;
            }
        ],
        'user.email',
        'sum:currency',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {update}  {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', [
                        'view',
                        'id' => $model->id
                    ]
                    );
                },
            ],
        ],
    ],
]) ?>
