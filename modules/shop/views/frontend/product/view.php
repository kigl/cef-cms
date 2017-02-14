<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->setBreadcrumbs($data['breadcrumbs']);


$this->params['groupId'] = $data['model']->group_id;
?>

<div class="product-detail">
    <div class="row">
        <div class="col-md-6">
            <div class="product-main-image">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Главная картинка
                    </div>
                    <div class="panel-body">
                        <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $data['mainImage']]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= \app\modules\shop\widgets\frontend\moreImages\Widget::widget(['model' => $data['images']]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><?= HtmlPurifier::process($data['model']->content); ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Блок информации</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-group-name"><?= Html::encode($data['model']->group->name); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-code"><?= Html::encode($data['model']->code); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-price">
                                <?= Yii::t('shop', 'Price: {price, number, currency}',
                                    ['price' => $data['model']->price]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php /*
                            <?= \app\modules\shop\widgets\frontend\checkedProductProperties\Widget::widget([
                                'model' => $data->getModel(),
                                'propertyId' => 1,
                                'radioName' => 'size',
                            ]) ?>

                            <?= \app\modules\shop\widgets\frontend\checkedProductProperties\Widget::widget([
                                'model' => $data->getModel(),
                                'propertyId' => 3,
                                'radioName' => 'length',
                            ]) ?>
                            */ ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="<?= $data['model']->id; ?>" id="productId"/>
                            <?= Html::textInput('', '', [
                                'class' => 'form-control',
                                'id' => 'qty',
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::a(Yii::t('shop', 'Button add to cart'), '#', [
                                'class' => 'btn btn-primary',
                                'onclick' => "addToCart(document.getElementById('productId').value, document.getElementById('qty').value);
                return false;",
                            ]); ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Свойства товара</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= \yii\widgets\DetailView::widget([
                                'model' => $data['properties'],
                                'attributes' => ['size', 'color'],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>