<?php
use app\modules\forms\Module;

$this->setTitle(Module::t('Create field'));
$this->setPageHeader(Module::t('Create field'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);