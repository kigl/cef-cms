<?php
$this->setPageHeader(Yii::t('app', 'Create: {data}', ['data' => 'группы']));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>
<?= $this->render('_form', ['data' => $data]);?>