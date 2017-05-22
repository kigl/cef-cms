<?php
use app\modules\infosystems\Module;

$this->setTitle(Module::t('Edit group: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit group: {data}', ['data' => $data['model']->name]));

echo $this->render('_form', ['data' => $data]);