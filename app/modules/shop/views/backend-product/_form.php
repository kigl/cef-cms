<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\modules\backend\widgets\ActiveForm;
use app\modules\shop\models\backend\Property;
use app\modules\backend\widgets\grid\GridView;
use app\modules\shop\models\backend\Image;
use app\modules\lists\widgets\DropDownItems;
use app\core\widgets\DropDownTreeItems;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t('app', 'Tab images'); ?></a></li>

    <?php if ($data['productProperties']) : ?>
        <li><a href="#property" data-toggle="tab"><?= Yii::t('app', 'Tab properties') ?></a></li>
    <?php endif; ?>

    <?php if (is_null($data['model']->parent_id) && !$data['model']->isNewRecord) : ?>
        <li><a href="#modifications" data-toggle="tab"><?= Yii::t('shop', 'Tab modifications'); ?></a></li>
    <?php endif; ?>

    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Tab more'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]); ?>

<?= $form->errorSummary(array_merge($data['productProperties'], [$data['model']])); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-12"><?= $form->field($data['model'], 'name'); ?></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($data['model'], 'group_id')
                    ->widget(DropDownTreeItems::className(), [
                        'modelClass' => \app\modules\shop\models\Group::className(),
                    ])
                    ->label(Yii::t('app', 'Group')); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($data['model'], 'code'); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($data['model'],
                    'status')->dropDownList($data['model']->getListStatus()); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($data['model'], 'price')
                    ->widget(\kartik\money\MaskMoney::className(), [
                        'pluginOptions' => [
                            'prefix' => 'RUR ',
                        ]
                    ]); ?>
            </div>
            <div class="col-md-6"><?= $form->field($data['model'], 'sku'); ?></div>
        </div>

        <?= $form->field($data['model'], 'description')->textarea(); ?>

    </div>

    <div class="tab-pane" id="content">
        <?= $form->field($data['model'], 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>
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
        <?php
        /*
         * @todo
         * Вынести в виджет
         */ ?>
        <?php foreach ($data['productProperties'] as $property): ?>
            <?php if ($data['properties'][$property->property_id]->type === Property::TYPE_STRING) : ?>
                <?= $form->field($property, "[{$property->property_id}]value")
                    ->label($data['properties'][$property->property_id]->name); ?>
            <?php elseif ($data['properties'][$property->property_id]->type === Property::TYPE_TEXTAREA) : ?>
                <?= $form->field($property, "[{$property->property_id}]value")
                    ->textarea()
                    ->label($data['properties'][$property->property_id]->name); ?>
            <?php elseif ($data['properties'][$property->property_id]->type === Property::TYPE_CHECKBOX) : ?>
                <?= $form->field($property, "[{$property->property_id}]value")
                    ->checkbox(['label' => $data['properties'][$property->property_id]->name]); ?>
            <?php elseif ($data['properties'][$property->property_id]->type === Property::TYPE_SELECT) : ?>
                <?= $form->field($property, "[{$property->property_id}]value")
                    ->widget(DropDownItems::className(),
                        ['listId' => $data['properties'][$property->property_id]->list_id])
                    ->label($data['properties'][$property->property_id]->name); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="tab-pane" id="modifications">
        <?php if (is_null($data['model']->parent_id) && !$data['model']->isNewRecord) : ?>
            <?= GridView::widget([
                'dataProvider' => $data['dataProvider'],
                'buttons' => [
                    'create' => [
                        'item' => [
                            'url' => Url::to([
                                'backend-product/create',
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
                                        'backend-product/update',
                                        'id' => $model->id
                                    ]
                                );
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                                    'backend-product/delete',
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

    <div class="tab-pane" id="seo">
        <?= $form->field($data['model'], 'alias'); ?>
        <?= $form->field($data['model'], 'meta_title'); ?>
        <?= $form->field($data['model'], 'meta_description'); ?>
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
