<?php
use kigl\cef\module\shop\Module;

$this->setTitle(Module::t('Create product'));
$this->setPageHeader(Module::t('Create product'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= $this->render('_form', ['data' => $data]);?>