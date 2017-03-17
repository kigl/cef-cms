<?php
use kigl\cef\module\infosystem\Module;

$this->setTitle(Module::t('Edit group: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit group: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = array_merge(
    [['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']]],
    $data['breadcrumbs']);

echo $this->render('_form', ['data' => $data]);