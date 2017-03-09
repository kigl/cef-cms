<?php
use app\modules\user\Module;

$this->setTitle(Module::t('Edit user property: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit user property: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('User properties'), 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);?>

