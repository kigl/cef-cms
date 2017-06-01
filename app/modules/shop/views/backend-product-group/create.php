<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Create group'));
$this->setPageHeader(Module::t('Create group'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>
<?= $this->render('_form', ['data' => $data]);?>