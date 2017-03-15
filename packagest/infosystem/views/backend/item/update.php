<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Edit item: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit item: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = array_merge([['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']]], $data['breadcrumbs']);
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];


echo $this->render('_form', ['data' => $data]);