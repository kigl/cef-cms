<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Create item'));
$this->setPageHeader(Module::t('Create item'));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);