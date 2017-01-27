<?php
use yii\helpers\Html;
use app\core\widgets\showContentModal\Widget as ShowContentModal;

\app\modules\backend\views\assets\Asset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="height-all">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>"/>
        <title><?= Html::encode($this->title); ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head(); ?>
    </head>
    <body class="height-all">
    <?php $this->beginBody(); ?>
    <div class="container-fluid wrapper height-all">
        <div class="height-all">
            <?= $content; ?>
        </div>
    </div>

    <?= ShowContentModal::widget([
        'options' => [
            'size' => \yii\bootstrap\Modal::SIZE_LARGE,
        ]
    ]); ?>

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>