<?php

/* @var $this \app\core\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\templates\black\assets\Asset::register($this);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $this->getMetaDescription(),
]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->getTitle()); ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $this->theme->baseUrl; ?>/web/css/main.css"/>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid no-padding no-margin">
    <?= $content; ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
