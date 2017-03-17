<?php
use kigl\cef\module\service\Module;

$this->setTitle(Module::t('Create form field'));
$this->setPageHeader(Module::t('Create form field'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);