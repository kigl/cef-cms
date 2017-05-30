<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Edit tag: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit tag: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);