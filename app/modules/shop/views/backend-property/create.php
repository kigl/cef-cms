<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Create product property'));
$this->setPageHeader(Module::t('Create product property'));
$this->params['breadcrumbs'] = [
    ['label' => Module::t('Products'), 'url' => ['backend-group/manager']],
    ['label' => Module::t('Product properties')],
];

echo $this->render('_form', ['model' => $model]);?>