<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => 'страницы', 'url' => ['manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);?>