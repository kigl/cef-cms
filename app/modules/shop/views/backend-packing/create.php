<?php
use app\modules\shop\Module;

$text = Module::t('Create packing');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);