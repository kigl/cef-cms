<?php
use app\modules\service\Module;

$this->setTitle(Module::t('Create menu'));
$this->setPageHeader(Module::t('Create menu'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Menu'), 'url' => ['menu/menu/manager']];

echo $this->render('_form', ['model' => $model]);