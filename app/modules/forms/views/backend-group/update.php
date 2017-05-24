<?php
use app\modules\forms\Module;

$this->setTitle(Module::t('Edit group: {name}', ['name' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit group: {name}', ['name' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);