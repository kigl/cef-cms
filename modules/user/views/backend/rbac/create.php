<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Toolbar rbac'), 'url' => ['rbac/manager']];

$this->setPageHeader(Yii::t('app', 'Create: {data}', ['data' => 'роли/привелегии']));

echo $this->render('_form', ['data' => $data]);?>
