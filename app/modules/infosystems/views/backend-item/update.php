<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Edit item: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit item: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);