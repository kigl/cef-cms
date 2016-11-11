<?php

namespace app\modules\user\controllers\frontend;

use Yii;
use app\modules\frontend\components\Controller;
use app\modules\user\models\User;
use app\modules\user\models\LoginForm;

class DefaultController extends Controller
{
	
	public function actionLogin()
	{		
		$model = new LoginForm();

		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		if ($model->load(Yii::$app->request->post()) and $model->login()) {
			return $this->goBack();
		}
		return $this->render('login', ['model' => $model]);
	} 
	
	public function actionRegistration()
	{
		$model = new User;
		$model->scenario = 'insert';
		
		if (Yii::$app->user->isGuest) {
			if ($model->load(Yii::$app->request->post()) and $model->save()) {
				return $this->goBack();
			} 
			return $this->render('registration', ['model' => $model]);
		} else {
			return $this->goBack();
		}
	}
	
	public function actionLogout()
	{
		Yii::$app->user->logout();
		
		return $this->goHome();
	}
}
