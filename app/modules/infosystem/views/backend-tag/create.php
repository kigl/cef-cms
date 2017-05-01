<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Create tag'));
$this->setPageHeader(Module::t('Create tag'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Tags'), 'url' => ['manager']];

echo $this->render('_form', ['data' => $data]);