<?php
use yii\helpers\HtmlPurifier;

$this->setTitle($model->meta_title);
$this->setMetaDescription($model->meta_description);
$this->setPageHeader($model->name);
$this->setBreadcrumbs([
    ['label' => $model->name],
]);
?>

<?= HtmlPurifier::process($model->content);?>

<?php
if (is_file($model->getDynamicPageFileUrl())) {
    echo $this->renderFile($model->getDynamicPageFileUrl());
}
?>