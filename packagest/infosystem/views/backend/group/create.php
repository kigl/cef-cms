<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Create group'));
$this->setPageHeader(Module::t('Create group'));

$this->params['breadcrumbs'] = array_merge(
    [['label' => 'Инфосистемы', 'url' => ['infosystem/manager']]],
    $data['breadcrumbs']);

echo $this->render('_form', ['data' => $data]);