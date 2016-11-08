<?php

namespace app\modules\forum\controllers;

class DefaultController extends \app\modules\forum\controllers\FrontendControllerAbstract
{
	public function actionIndex()
	{
		return $this->render('index', [
			'breadcrumbs' => static::buildBreadcrumbs(),
		]);
	}
}