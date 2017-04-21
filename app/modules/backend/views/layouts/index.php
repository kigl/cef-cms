<?php
use yii\helpers\Html;
use app\core\widgets\showContentModal\Widget as ShowContentModal;
use app\modules\backend\views\assets\Asset;

Asset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="<?= Yii::$app->charset; ?>"/>
        <title><?= Html::encode($this->title); ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head(); ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody(); ?>
    <div class="container-fluid wrapper no-padding ">
        <?= $content; ?>
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