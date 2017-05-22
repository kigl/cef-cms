<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Edit property: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit property: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']];
$this->params['breadcrumbs'][] = [
    'label' => $data['infosystem']->name,
    'url' => ['infosystem/update', 'id' => $data['infosystem']->id]
];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);