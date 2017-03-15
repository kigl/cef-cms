<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget;

?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
        <li><a href="#properties" data-toggle="tab"><?= Yii::t('app', 'Tab properties'); ?></a></li>
        <li><a href="#settings" data-toggle="tab"><?= Yii::t('app', 'Tab settings'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->errorSummary($data['model']); ?>

    <div class="tab-content">
        <div class="tab-pane active" id="main">
            <?= $form->field($data['model'], 'id'); ?>

            <?= $form->field($data['model'], 'name'); ?>

            <?= $form->field($data['model'], 'description')->textArea(); ?>

            <?= $form->field($data['model'], 'content')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 400,
                ],
            ]); ?>
        </div>

        <div class="tab-pane" id="properties">
            <?php if (!empty($data['model']->id)) : ?>
                <?= \app\modules\backend\widgets\grid\GridView::widget([
                    'dataProvider' => $data['dataProvider'],
                    'buttons' => [
                        'create' => [
                            'item' => [
                                'url' => Url::to(['property/create', 'infosystem_id' => $data['model']->id]),
                            ],
                        ],
                    ],
                    'rowOptions' => function ($model, $key, $index, $grid) {
                        return ['data-sortable-id' => $model->id];
                    },
                    'columns' => [
                        'name',
                        [
                            'class' => \kotchuprik\sortable\grid\Column::className(),
                        ],
                        'sorting',
                        'id',
                        [
                            'headerOptions' => ['style' => 'width: 70px'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update}  {delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['property/update', 'id' => $model->id]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['property/delete', 'id' => $model->id],
                                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]);
                                }
                            ],
                        ]
                    ],
                    'options' => [
                        'data' => [
                            'sortable-widget' => 1,
                            'sortable-url' => \yii\helpers\Url::to(['property/sorting']),
                        ]
                    ],
                ]); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane" id="settings">
            <?= $form->field($data['model'], 'template_group'); ?>

            <?= $form->field($data['model'], 'template_item'); ?>

            <?= $form->field($data['model'], 'item_on_page'); ?>
        </div>

    </div>
<?php ActiveForm::end(); ?>