<?php
use app\modules\shop\Module;

$message = Module::t('Create shop');

$this->setTitle($message);
$this->setPageHeader($message);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);