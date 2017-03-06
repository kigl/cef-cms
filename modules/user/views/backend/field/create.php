<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional properties'), 'url' => ['field/manager']];
$this->setPageHeader(Yii::t('app', 'Create'));

echo $this->render('_form', ['model' => $model]);?>

