<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */

$this->title = Yii::t('main', 'Update Page');
$this->breadcrumbs = [
	['label' => 'Новости', 'url' => ['manager']],
	['label' => Yii::t('main', 'breadcrumbs edit	')],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-sm btn-success">' . Yii::t('main', 'button save'). '</button>']
];
?>
<div class="well well-sm">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
