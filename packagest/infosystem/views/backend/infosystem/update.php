<?php
use kigl\cef\module\infosystem\Module;

$this->setTitle(Module::t( 'Edit infosystem: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t( 'Edit infosystem: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'][] = ['label' => 'Инфосистемы', 'url' => ['infosystem/manager']];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);