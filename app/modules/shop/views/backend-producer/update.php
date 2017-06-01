<?php
use app\modules\shop\Module;

$text = Module::t('Edit producer: {data}', ['data' => $data['model']->name]);

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);