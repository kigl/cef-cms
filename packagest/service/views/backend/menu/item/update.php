<?php
use kigl\cef\module\service\Module;

$this->setTitle(Module::t('Edit menu item: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit menu item: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);