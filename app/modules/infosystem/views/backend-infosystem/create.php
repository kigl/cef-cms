<?php
use app\modules\infosystem\Module;

$this->setTitle(Module::t('Create infosystem'));
$this->setPageHeader(Module::t('Create infosystem'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Infosystems'), 'url' => ['backend-infosystem/manager']];

echo $this->render('_form', ['data' => $data]);