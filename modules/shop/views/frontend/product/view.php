<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getTitle());
$this->setMetaDescription($data->getMetaDescription());
$this->setPageHeader($data->getName());

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

$this->params['groupId'] = $data->getGroupId();

$this->registerJs("
$(function () {
    $('.product-property__item').click(function () {
        var url = $(this);
        $.ajax({
                                type: 'GET',
                                url: url.attr('href'),
                                success: function (data) {
            var product = $.parseJSON(data);
            $('.product-price').html(product.price);
            $('#productId').val(product.id);
        }
                            });
                            return false;
                        });
});
");
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
                            <ul>
                                <?php
                                echo "<li>" . Html::a(
                                        $data->getModel()->properties[0]->value,
                                        ['/shop/product/get-value', 'id' => $data->getModel()->id],
                                        ['class' => 'product-property__item']
                                    );

                                foreach ($data->getSubProducts() as $product) {
                                    echo "<li>" . Html::a(
                                            $product->properties[0]->value,
                                            ['/shop/product/get-value', 'id' => $product->id],
                                            ['class' => 'product-property__item']
                                        );
                                }
                                ?>
                            </ul>
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