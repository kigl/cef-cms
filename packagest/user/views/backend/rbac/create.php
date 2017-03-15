<?php
use kigl\cef\module\user\Module;

$this->setTitle(Module::t('Create RBAC'));
$this->setPageHeader(Module::t('Create RBAC'));
$this->params['breadcrumbs'][] = ['label' => Module::t('RBAC'), 'url' => ['manager']];

echo $this->render('_form', ['data' => $data]);?>
