<?php
use app\modules\user\Module;

$this->setTitle(Module::t('Create user property'));
$this->setPageHeader(Module::t('Create user property'));
$this->params['breadcrumbs'] = [
    ['label' => Module::t('Users'), 'url' => ['backend-user/manager']],
    ['label' => Module::t('User properties'), 'url' => ['backend-property/manager']],
];
?>

echo $this->render('_form', ['model' => $model]);?>

