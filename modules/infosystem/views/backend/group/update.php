<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo $this->render('_form', ['data' => $data]);