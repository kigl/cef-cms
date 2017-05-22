<?php
use app\modules\users\Module;

$this->setTitle(Module::t('Edit user property: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit user property: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'] = [
    ['label' => Module::t('Users'), 'url' => ['backend-user/manager']],
    ['label' => Module::t('User properties'), 'url' => ['backend-property/manager']],
    ['label' => $model->name],
];

echo $this->render('_form', ['model' => $model]);?>

