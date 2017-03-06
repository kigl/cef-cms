<?php
$this->setPageHeader(Yii::t('app', 'Create {data}', ['data' => 'страницы']));

echo $this->render('_form', ['model' => $model]);?>