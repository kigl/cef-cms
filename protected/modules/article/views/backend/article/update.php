<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\article\models\Article */

$this->pageHeader = Yii::t('main', 'article update');
$this->breadcrumbs = [
	['label' => 'Статьи', 'url' => ['manager']],
	['label' => 'Редактирование'],
];
?>
<div class="page-create well well-sm">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
