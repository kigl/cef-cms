<?php
use kigl\cef\module\user\Module;

$this->setTitle(Module::t('Edit RBAC: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit RBAC: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('RBAC'), 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);