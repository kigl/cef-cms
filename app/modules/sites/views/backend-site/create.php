<?php
use app\modules\sites\Module;

$this->setTitle(Module::t('Create site'));
$this->setPageHeader(Module::t('Create site'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Sites'), 'url' => 'manager'];

echo $this->render('_form', ['model' => $model]);