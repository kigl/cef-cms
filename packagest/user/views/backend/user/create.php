<?php
use kigl\cef\module\user\Module;

$this->setTitle(Module::t('Create user'));
$this->setPageHeader(Module::t('Create user'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Users'), 'url' => ['manager']];

echo $this->render('_form', ['data' => $data]);


