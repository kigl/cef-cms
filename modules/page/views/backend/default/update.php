<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $model->name]));

echo $this->render('_form', ['model' => $model]);?>