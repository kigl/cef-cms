<?php

$this->params['breadcrumbs'] = $breadcrumbs;

echo $this->render('_form', ['model' => $model, 'group_id' => $group_id]);
?>