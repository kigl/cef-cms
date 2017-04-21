<?php
use app\modules\form\Module;
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Html;

$this->setTitle(Module::t('Completed forms'));
$this->setPageHeader(Module::t('Completed forms'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'create_time:datetime',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{view} {delete}",
            'buttons' => [
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
