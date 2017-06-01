<?php
use app\modules\shop\Module;

$text = Module::t('Edit product property: {data}', ['data' => $data['model']->name]);

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);