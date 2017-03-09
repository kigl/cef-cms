<?php
use app\modules\user\Module;

$this->setTitle(Module::t('Create user property'));
$this->setPageHeader(Module::t('Create user property'));
$this->params['breadcrumbs'][] = ['label' => Module::t('User properties'), 'url' => ['manager']];

echo $this->render('_form', ['model' => $model]);?>

