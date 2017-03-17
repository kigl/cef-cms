<?php
use kigl\cef\module\shop\Module;

$this->setTitle(Module::t('Edit product: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit product: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

?>

<?= $this->render('_form', ['data' => $data]);?>