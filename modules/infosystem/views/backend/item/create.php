<?php
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'элемента']));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);