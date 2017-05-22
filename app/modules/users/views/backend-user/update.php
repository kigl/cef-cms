<?php
use app\modules\users\Module;

$this->setTitle(Module::t('Edit user: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit user: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Users'), 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);


