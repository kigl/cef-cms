<?php

namespace app\modules\user\controllers\backend;

use Yii;
use app\modules\user\models\User;
use yii\data\ActiveDataProvider;

class UserController extends \app\modules\main\components\controllers\BackendController
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
				'model' => '\app\modules\user\	models\User',
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
				'pagination' => [
					'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
				],
			]);
		return $this->render('manager', ['dataProvider' => $dataProvider]);
	}
	
	public function actionPassword($id)
	{
		$model = User::findOne($id);
		$model->scenario = 'passwordEdit';
		
			if ($model->load(Yii::$app->request->post()) and $model->save()) {
				return $this->redirect(['manager']);	
			}

		
		return $this->render('password', ['model' => $model]);
	}
}
