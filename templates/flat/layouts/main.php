<?php

/* @var $this \app\core\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

\app\modules\frontend\views\assets\Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->getTitle()); ?></title>
    <meta name="description" content="<?= Html::encode($this->getMetaDescription()); ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container wrapper">
    <div class="panel panel-default">
        <div class="panel-heading">Верхний блок</div>
        <div class="panel-body">
            <div class="top-block">
                <div class="row">
                    <div class="col-md-12">
                        <?= app\modules\service\modules\menu\widgets\frontend\menu\Menu::widget([
                            'menuId' => 1,
                            'options' => ['class' => 'list-inline pull-right'],
                        ]);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Блок голова</div>
        <div class="panel-body">
            <div class="header-block">
                <div class="row">
                    <div class="col-md-8">
                        <?= \app\modules\shop\widgets\frontend\searchProduct\Widget::widget(); ?>
                    </div>
                    <div class="col-md-offset-2 col-md-2">
                        <?= \app\modules\shop\widgets\frontend\cart\Widget::widget([
                                'urlPageCart' => Url::to(['/shop/cart/index']),
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Блок контента</div>
        <div class="panel-body">
            <div class="content-block">
                <div class="row">
                    <div class="col-md-12">
                        <?= $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= \app\core\widgets\showContentModal\widget::widget([
            'options' => [
                    'size' => \yii\bootstrap\Modal::SIZE_LARGE,
            ],
    ]); ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
