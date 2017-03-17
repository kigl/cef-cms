<?php
use kigl\cef\module\service\Module;

$this->setTitle(Module::t('Edit menu: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit menu: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Menu'), 'url' => ['menu/menu/manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);