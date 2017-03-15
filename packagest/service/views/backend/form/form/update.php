<?php
use app\modules\service\Module;

$this->setTitle(Module::t('Edit form: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit form: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Forms'), 'url' => ['form/form/manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);