<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;
use yii\bootstrap\Html;

$this->setTitle($data->getTitle());

$this->setBreadcrumbs(
    \yii\helpers\ArrayHelper::merge(
        Breadcrumbs::getLinksGroup(
            $data->getGroupId(),
            [
                'modelClass' => Group::className(),
                'enableRoot' => false,
                'urlOptions' => [
                    'route' => '/shop/product/list',
                    'queryGroupName' => 'group_id',
                ],
            ]
        ), ['label' => Html::encode($data->getName())]));
//$this->setPageHeader(Html::encode($data->getName()));
?>

<div class="product-detail">
    <div class="row">
        <div class="col-md-6">
            <div class="product-main-image">
                <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $data->getMainImage()]); ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= \app\modules\shop\widgets\frontend\moreImages\Widget::widget(['model' => $data->getImages()]);?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-name"><?= Html::encode($data->getName()); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-group-name"><?= Html::encode($data->getGroupName()); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-code"><?= Html::encode($data->getCode());?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-price"><?= $data->getPrice(); ?></div>
                </div>
            </div>
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

