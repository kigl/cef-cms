<?php

/* @var $this \app\core\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
