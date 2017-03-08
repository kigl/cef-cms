<?php
//$this->setTitle();
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'инфосистемы']));
$this->params['breadcrumbs'][] = ['label' => 'Инфосистемы', 'url' => ['infosystem/manager']];

echo $this->render('_form', ['data' => $data]);