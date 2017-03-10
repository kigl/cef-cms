<?php

$this->setTitle(Yii::t('app','Settings module: {data}', ['data' => $this->module->getName()]));
$this->setPageHeader(Yii::t('app','Settings module: {data}', ['data' => $this->module->getName()]));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings')];

echo $this->render('_form', ['data' => $data]);