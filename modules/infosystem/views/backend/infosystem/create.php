<?php
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'инфосистемы']));

echo $this->render('_form', ['data' => $data]);