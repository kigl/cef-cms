<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Create group'));
$this->setPageHeader(Module::t('Create group'));

echo $this->render('_form', ['data' => $data]);