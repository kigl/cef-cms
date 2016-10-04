<?php
use yii\web\HttpException;

$this->params['breadcrumbs'] = $breadcrumbs;

if (!Yii::$app->user->can('updateOwnItem', ['model' => $model])) {
	throw new HttpException('403');
}

echo $this->render('_form', ['model' => $model, 'group_id' => $model->parent_id]);
?>