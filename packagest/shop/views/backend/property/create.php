<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Create product property'));
$this->setPageHeader(Module::t('Create product property'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Product properties'), 'url' => ['property/manager']];

echo $this->render('_form', ['model' => $model]);?>