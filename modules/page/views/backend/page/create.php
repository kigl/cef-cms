<?php
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'страницы']));
$this->params['breadcrumbs'][] = ['label' => 'страницы', 'url' => ['manager']];

echo $this->render('_form', ['model' => $model]);?>