<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = array_merge([['label' => 'Инфосистемы', 'url' => ['infosystem/manager']]], $data['breadcrumbs']);
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];


echo $this->render('_form', ['data' => $data]);