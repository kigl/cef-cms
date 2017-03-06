<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => 'дополнительные свойства', 'url' => ['property/manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);?>