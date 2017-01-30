<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\modules\backend\widgets\ActiveForm;
use app\modules\shop\models\Property;
use app\modules\backend\widgets\grid\GridView;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('shop', 'Tab main'); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t('shop', 'Tab images'); ?></a></li>
    <li><a href="#property" data-toggle="tab"><?= Yii::t('shop', 'Tab property') ?></a></li>
    <li><a href="#modifications" data-toggle="tab"><?= Yii::t('shop', 'Tab modifications'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('shop', 'Tab other'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data->getModel()); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-4"><?= $form->field($data->getModel(), 'code'); ?></div>
            <div class="col-md-4"><?= $form->field($data->getModel(), 'name'); ?></div>
            <div class="col-md-4"><?= $form->field($data->getModel(),
                    'status')->dropDownList($data->getModel()->getListStatus()); ?></div>
        </div>

        <div class="row">
            <div class="col-md-4"><?= $form->field($data->getModel(), 'price')
                    ->widget(\kartik\money\MaskMoney::className(), [
                        'pluginOptions' => [
                            'prefix' => 'RUR ',
                        ]
                    ]); ?>
            </div>
            <div class="col-md-4"><?= $form->field($data->getModel(), 'sku'); ?></div>
        </div>

        <?= $form->field($data->getModel(), 'description')->textarea(); ?>

        <?= $form->field($data->getModel(), 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>

        <?= $form->field($data->getModel(), 'alias'); ?>

        <?= $form->field($data->getModel(), 'meta_title'); ?>

        <?= $form->field($data->getModel(), 'meta_description')->textarea(); ?>
    </div>

    <div class="tab-pane" id="images">
        <?= $form->field($data->getModel(), 'imageUpload[]')->fileInput(['multiple' => true]); ?>
        <div class="row">
            <?php foreach ($data->getImages() as $image) : ?>
                <div class="col-md-3">
                    <div class="img-thumbnail">
                        <?= $form->field($image, '[' . $image->id . ']deleteKey')->checkbox(); ?>
                        <div class="form-group">
                            <label class="control-label">
                                <?= Html::radio('imageStatus', $image->status, ['views' => $image->id]); ?>
                                <?= Yii::t('shop', 'Image status') ?>
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
        <?php foreach ($data->getProperties() as $value): ?>
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
        <?php if (is_null($data->getParentId())) : ?>
            <?= GridView::widget([
                'dataProvider' => $data->getDataProvider(),
                'buttons' => [
                    'create' => [
                        'item' => [
                            'url' => Url::to([
                                'product/create',
                                'group_id' => $data->getGroupId(),
                                'parent_id' => $data->getId(),
                            ]),
                        ],
                    ],
                ],
                'columns' => [
                    'id',
                    'name',
                    'price:currency',
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
                                    ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
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
            'model' => $data->getModel(),
            'attributes' => [
                'id',
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => Html::a($data->getModel()->user_id,
                        ['/backend/user/default/view', 'id' => $data->getModel()->user_id]),
                ],
            ],
        ]); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
