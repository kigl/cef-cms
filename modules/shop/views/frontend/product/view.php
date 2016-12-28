<?php
use yii\helpers\Html;
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->setTitle($data->getTitle());
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
                        <div class="col-md-6">
                            <?= Html::textInput('', '', [
                                'class' => 'form-control',
                                'id' => 'qty_' . $data->getId(),
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::a(Yii::t('shop', 'Button add to cart'), '', [
                                'class' => 'btn btn-primary',
                                'onclick' => "addToCart({$data->getId()}, document.getElementById('qty_{$data->getId()}').value);
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
                                'model' => $data->getProperty(),
                                'attributes' => ['size'],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

