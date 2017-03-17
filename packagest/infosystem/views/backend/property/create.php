<?php
use kigl\cef\module\infosystem\Module;

$this->setTitle(Module::t('Create property'));
$this->setPageHeader(Module::t('Create property'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']];
$this->params['breadcrumbs'][] = ['label' => $data['infosystem']->name, 'url' => ['infosystem/update', 'id' => $data['infosystem']->id]];

echo $this->render('@app/modules/property/views/_form', ['data' => $data]);