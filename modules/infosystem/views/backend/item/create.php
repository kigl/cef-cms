<?php
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'элемента']));

$this->params['breadcrumbs'] = array_merge([['label' => 'Инфосистемы', 'url' => ['infosystem/manager']]], $data['breadcrumbs']);

echo $this->render('_form', ['data' => $data]);