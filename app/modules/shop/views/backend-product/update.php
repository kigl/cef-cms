<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Edit product: {data}', ['data' => $data['model']->name]));
$this->setPageHeader(Module::t('Edit product: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= $this->render('_form', ['data' => $data]);?>