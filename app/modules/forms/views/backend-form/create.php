<?php
use app\modules\forms\Module;

$this->setTitle(Module::t('Create'));
$this->setPageHeader(Module::t('Create'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Forms'), 'url' => ['form/form/manager']];

echo $this->render('_form', ['model' => $model]);