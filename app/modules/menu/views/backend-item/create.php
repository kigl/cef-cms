<?php
use app\modules\menu\Module;

$this->setTitle(Module::t('Create menu item'));
$this->setPageHeader(Module::t('Create menu item'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);