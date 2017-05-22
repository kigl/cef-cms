<?php
use app\modules\sites\Module;

$this->setTitle(Module::t('Create template'));
$this->setPageHeader(Module::t('Create template'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Templates'), 'url' => ['manager']];

echo $this->render('_form', ['model' => $model]);