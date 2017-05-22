<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Create property'));
$this->setPageHeader(Module::t('Create property'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']];
$this->params['breadcrumbs'][] = ['label' => $data['infosystem']->name, 'url' => ['infosystem/update', 'id' => $data['infosystem']->id]];

echo $this->render('_form', ['data' => $data]);