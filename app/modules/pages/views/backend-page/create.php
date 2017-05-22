<?php
use app\modules\pages\Module;

$this->setTitle(Module::t('Create page'));
$this->setPageHeader(Module::t('Create page'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Pages'), 'url' => ['manager']];

echo $this->render('_form', ['model' => $model]);?>