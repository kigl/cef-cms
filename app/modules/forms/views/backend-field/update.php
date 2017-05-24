<?php
use app\modules\forms\Module;

$this->setTitle(Module::t('Edit field: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit field: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);