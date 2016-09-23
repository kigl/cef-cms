<?php

namespace app\modules\user\traits;

use Yii;
use app\modules\user\models\LoginForm;

trait User 
{
	public function Login()
	{		
		$model = new LoginForm();

		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		if ($model->load(Yii::$app->request->post()) and $model->login()) {
			return $this->goBack();
		}
		
		echo $this->render('login', ['model' => $model]);
	} 
} 

?>