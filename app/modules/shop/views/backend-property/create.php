<?php
use app\modules\shop\Module;

$text = Module::t('Create product property');

$this->setTitle($text);
$this->setPageHeader(Module::t('Create product property'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);