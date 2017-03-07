<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = array_merge(
    [['label' => 'Инфосистемы', 'url' => ['infosystem/manager']]],
    $data['breadcrumbs']);

echo $this->render('_form', ['data' => $data]);