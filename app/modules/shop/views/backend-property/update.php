<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Edit product property: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit product property: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'] = [
    ['label' => Module::t('Products'), 'url' => ['backend-group/manager']],
    ['label' => Module::t('Product properties'), 'url' => ['backend-property/manager']],
    ['label' => $model->name],
];

echo $this->render('_form', ['model' => $model]);?>