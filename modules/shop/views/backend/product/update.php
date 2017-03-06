<?php
$this->setPageHeader(Yii::t('app', 'Edit: {data}', ['data' => $data['model']->name]));
$this->params['breadcrumbs'] = $data['breadcrumbs'];
$this->params['breadcrumbs'][] = ['label' => $data['model']->name];

?>

<?= $this->render('_form', ['data' => $data]);?>

