<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Create tag'));
$this->setPageHeader(Module::t('Create tag'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);