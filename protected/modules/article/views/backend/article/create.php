<?php
use yii\helpers\Html;

$this->pageHeader = Yii::t('main', 'article create');
$this->breadcrumbs = [
	['label' => 'Статьи', 'url' => ['manager']],
	['label' => 'Создание'],
];


?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
