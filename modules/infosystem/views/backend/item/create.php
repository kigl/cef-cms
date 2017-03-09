<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Create item'));
$this->setPageHeader(Module::t('Create item'));

$this->params['breadcrumbs'] = array_merge([['label' => Module::t('Infosystems'), 'url' => ['infosystem/manager']]], $data['breadcrumbs']);

echo $this->render('_form', ['data' => $data]);