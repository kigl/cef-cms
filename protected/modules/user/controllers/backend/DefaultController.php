<?php

namespace app\modules\user\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\user\Module;
use app\modules\user\models\User;

class DefaultController extends \app\modules\main\components\controllers\BackendController
{

	public function actions()
	{
		return [
			'create' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model' => '\app\modules\user\models\User',
				'scenario' => 'insert',
			],
			'update' => [
				'class' => 'app\modules\main\components\actions\UpdateAction',
				'model' => '\app\modules\user\models\User',
				'scenario' => 'update',
			],
			'delete' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model' => '\app\modules\user\models\User',
			],
		];
	}

	public function actionManager()
	{
		$dataProvider = new ActiveDataProvider([
				'query' => User::find(),
				'sort' => ['attributes' => ['id', 'login', 'email', 'status']],
			]);
		return $this->render('manager', ['dataProvider' => $dataProvider]);
	}
}
