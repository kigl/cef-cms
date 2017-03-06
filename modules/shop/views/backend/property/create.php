<?php
$this->setPageHeader(Yii::t('app', 'Create: {data}', ['data' => 'дополнительное свойство']));
$this->params['breadcrumbs'][] = ['label' => 'дополнительные свойства', 'url' => ['property/manager']];

echo $this->render('_form', ['model' => $model]);?>