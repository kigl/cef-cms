<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\infosystems\Module;
use app\modules\infosystems\models\backend\Group;
use app\modules\infosystems\models\backend\Item;
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
            <?= $form->field($data['model'], 'code'); ?>

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
                                'url' => Url::to(['backend-property/create', 'infosystem_id' => $data['model']->id]),
                            ],
                        ],
                        'delete' => [
                            'item' => [
                                'url' => ['backend-property/selection-delete'],
                            ],
                        ],
                    ],
                    'rowOptions' => function ($model, $key, $index, $grid) {
                        return ['data-sortable-id' => $model->id];
                    },
                    'columns' => [
                        [
                            'class' => \yii\grid\CheckboxColumn::className(),
                        ],
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
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                        ['backend-property/update', 'id' => $model->id]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                        ['backend-property/delete', 'id' => $model->id],
                                        [
                                            'date-method' => 'POST',
                                            'data-confirm' => Yii::t('app', 'question on delete file')
                                        ]);
                                }
                            ],
                        ]
                    ],
                    'options' => [
                        'class' => 'grid-view',
                        'data' => [
                            'sortable-widget' => 1,
                            'sortable-url' => \yii\helpers\Url::to(['property/sorting']),
                        ]
                    ],
                ]); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane" id="settings">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#main-settings" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
                <li><a href="#templates" data-toggle="tab"><?= Yii::t('app', 'Tab templates'); ?></a></li>
                <li><a href="#sorting" data-toggle="tab"><?= Yii::t('app', 'Tab sorting'); ?></a></li>
                <li><a href="#formats" data-toggle="tab"><?= Yii::t('app', 'Tab formats'); ?></a></li>
            </ul>

            <div class="tab-content well">
                <div class="tab-pane active" id="main-settings">
                    <?= $form->field($data['model'], 'indexing')->checkbox(); ?>

                    <?= $form->field($data['model'], 'group_on_page'); ?>

                    <?= $form->field($data['model'], 'item_on_page'); ?>
                </div>

                <div class="tab-pane" id="templates">

                    <?= $form->field($data['model'], 'template'); ?>

                    <?= $form->field($data['model'], 'template_group'); ?>

                    <?= $form->field($data['model'], 'template_item'); ?>

                    <?= $form->field($data['model'], 'template_tag'); ?>
                </div>

                <div class="tab-pane" id="sorting">
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($data['model'], 'sorting_type_group')
                                ->dropDownList($data['model']->getSortingTypes()); ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($data['model'], 'sorting_field_group')
                                ->dropDownList(Group::getSortingAttribute()); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($data['model'], 'sortingListFieldGroup')
                                ->dropDownList(Group::getSortingAttribute(), ['multiple' => true])
                                ->label(Module::t('Sorting list field group')); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($data['model'], 'sorting_type_item')
                                ->dropDownList($data['model']->getSortingTypes()); ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($data['model'], 'sorting_field_item')
                                ->dropDownList(Item::getSortingAttribute()); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($data['model'], 'sortingListFieldItem')
                                ->dropDownList(Item::getSortingAttribute(), ['multiple' => true])
                                ->label(Module::t('Sorting list field item')); ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="formats">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_width_image_description_group'); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_height_image_description_group'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_width_image_content_group'); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_height_image_content_group'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_width_image_description_item'); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_height_image_description_item'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_width_image_content_item'); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($data['model'], 'max_height_image_content_item'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php ActiveForm::end(); ?>