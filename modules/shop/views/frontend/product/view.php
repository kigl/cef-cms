<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$this->setTitle($data->getTitle());
$this->setMetaDescription($data->getMetaDescription());
$this->setPageHeader($data->getName());
/*
$this->setBreadcrumbs(
    \yii\helpers\ArrayHelper::merge(
        Breadcrumbs::getLinksGroup(
            $data->getGroupId(),
            [
                'modelClass' => Group::className(),
                'enableRoot' => false,
                'urlOptions' => [
                    'route' => '/shop/group/view',
                    'queryGroupName' => 'id',
                ],
            ]
        ), ['label' => Html::encode($data->getName())]));
*/
$this->params['groupId'] = $data->getGroupId();
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
                        <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $data->getMainImage()]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= \app\modules\shop\widgets\frontend\moreImages\Widget::widget(['model' => $data->getImages()]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><?= HtmlPurifier::process($data->getContent()); ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Блок информации</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-group-name"><?= Html::encode($data->getGroupName()); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-code"><?= Html::encode($data->getCode()); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-price"><?= $data->getPrice(); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="<?= $data->getId(); ?>" id="productId"/>
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
                                'model' => $data->getProperties(),
                                'attributes' => ['size', 'color'],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>