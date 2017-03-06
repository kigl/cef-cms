<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));

echo $this->render('_form', ['data' => $data]);