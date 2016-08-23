<?php
use yii\helpers\Html;

$this->pageHeader = Yii::t('main', 'article create');
$this->breadcrumbs = [
	['label' => 'Статьи', 'url' => ['manager']],
	['label' => 'Создание'],
];


?>
<div class="page-create well well-sm">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
