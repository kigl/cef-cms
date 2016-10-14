<?php

namespace app\modules\page\controllers;

use app\modules\page\models\Page;

class DefaultController extends \app\modules\main\components\controllers\FrontendController
{
	public function actionView($id)
	{
		$model = Page::findOne($id);

		return $this->render('view', ['model' => $model]);
	}
}
