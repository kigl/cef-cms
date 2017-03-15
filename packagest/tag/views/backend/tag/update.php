<?php
use app\modules\tag\Module;

$this->setTitle(Module::t('Edit tag: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit tag: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Tags'), 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

echo $this->render('_form', ['data' => $data]);