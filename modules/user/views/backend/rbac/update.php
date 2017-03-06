<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Toolbar rbac'), 'url' => ['rbac/manager']];
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));

echo $this->render('_form', ['data' => $data]);