<?php
use app\modules\service\Module;

$this->setTitle(Module::t('Create form'));
$this->setPageHeader(Module::t('Create form'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Forms'), 'url' => ['form/form/manager']];

echo $this->render('_form', ['model' => $model]);