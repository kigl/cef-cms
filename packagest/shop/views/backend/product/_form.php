<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\file\FileInput;
use kigl\cef\module\backend\widgets\ActiveForm;
use kigl\cef\module\shop\models\Property;
use kigl\cef\module\backend\widgets\grid\GridView;
use kigl\cef\module\shop\models\Image;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t('app', 'Tab images'); ?></a></li>
    <li><a href="#property" data-toggle="tab"><?= Yii::t('app', 'Tab properties') ?></a></li>
    <li><a href="#modifications" data-toggle="tab"><?= Yii::t('shop', 'Tab modifications'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Tab more'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->errorSummary(array_merge($data['properties'], [$data['model']]));?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-12"><?= $form->field($data['model'], 'name'); ?></div>
        </div>
        <div class="row">
            <div class="col-md-3"><?= $form->field($data['model'], 'code'); ?></div>
            <div class="col-md-3"><?= $form->field($data['model'], 'price')
                    ->widget(\kartik\money\MaskMoney::className(), [
                        'pluginOptions' => [
                            'prefix' => 'RUR ',
                        ]
                    ]); ?>
            </div>
            <div class="col-md-3"><?= $form->field($data['model'], 'sku'); ?></div>
            <div class="col-md-3"><?= $form->field($data['model'],
                    'status')->dropDownList($data['model']->getListStatus()); ?></div>
        </div>

        <?= $form->field($data['model'], 'description')->textarea(); ?>

        <?= $form->field($data['model'], 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>

    </div>
    <div class="tab-pane" id="seo">
        <?= $form->field($data['model'], 'alias'); ?>
        <?= $form->field($data['model'], 'meta_title'); ?>
        <?= $form->field($data['model'], 'meta_description'); ?>
    </div>
    <div class="tab-pane" id="images">
        <?= $form->field($data['model'], 'imageUpload[]')->widget(FileInput::class, [
            'options' => ['multiple' => true],
        ]); ?>
        <div class="row">
            <?php foreach ($data['model']->images as $image) : ?>
                <div class="col-md-3">
                    <div class="img-thumbnail">
                        <?= $form->field($image, '[' . $image->id . ']deleteKey')->checkbox(); ?>
                        <div class="form-group">
                            <label class="control-label">
                                <?= Html::radio(Image::POST_NAME_STATUS, $image->status, ['value' => $image->id]); ?>
                                <?= Yii::t('shop', 'Main image') ?>
                            </label>
                        </div>
                        <?= $form->field($image, '[' . $image->id . ']alt'); ?>
                        <img src="<?= $image->getFileUrl(); ?>" class="width-all"/>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="tab-pane" id="property">
        <?php foreach ($data['properties'] as $value): ?>
            <?php if ($value->property->type === Property::TYPE_STRING) : ?>
                <?= $form->field($value, "[{$value->property_id}]value")
                    ->label($value->property->name); ?>
            <?php elseif ($value->property->type === Property::TYPE_CHECKBOX) : ?>
                <?= $form->field($value, "[{$value->property_id}]value")
                    ->checkbox(['label' => false])
                    ->label($value->property->name); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="tab-pane" id="modifications">
        <?php if (is_null($data['model']->parent_id)) : ?>
            <?= GridView::widget([
                'dataProvider' => $data['dataProvider'],
                'buttons' => [
                    'create' => [
                        'item' => [
                            'url' => Url::to([
                                'product/create',
                                'parent_id' => $data['model']->id,
                            ]),
                        ],
                    ],
                ],
                'columns' => [
                    'name',
                    'price:currency',
                    'id',
                    [
                        'headerOptions' => ['style' => 'width: 70px'],
                        'class' => \yii\grid\ActionColumn::className(),
                        'template' => "{update} {delete}",
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                                        'product/update',
                                        'id' => $model->id
                                    ]
                                );
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                                    'product/delete',
                                    'id' => $model->id
                                ],
                                    [
                                        'date-method' => 'POST',
                                        'data-confirm' => Yii::t('app', 'question on delete file')
                                    ]
                                );
                            }
                        ],
                    ],
                ],
            ]); ?>
        <?php endif; ?>
    </div>

    <div class="tab-pane" id="other">
        <?= DetailView::widget([
            'model' => $data['model'],
            'attributes' => [
                'id',
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => Html::a($data['model']->user_id,
                        ['/backend/user/user/view', 'id' => $data['model']->user_id]),
                ],
            ],
        ]); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>