<?php
use yii\helpers\Html;
use kigl\cef\module\user\Module;
use kigl\cef\module\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Users'));
$this->setPageHeader(Module::t('Users'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Users')];
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'buttons' => ['create' => ['item']],
    'columns' => [
        'login',
        [
            'attribute' => 'status',
            'value' =>
                function ($data) {
                    return $data->getStatus($data->status);
                },
        ],
        'email',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {update}  {delete}',
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
]);
?>
