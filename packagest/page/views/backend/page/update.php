<?php
use kigl\cef\module\page\Module;

$this->setTitle(Module::t('Edit page: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit page: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Pages'), 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => Module::t('Edit page: {data}', ['data' => $model->name])];

echo $this->render('_form', ['model' => $model]);?>