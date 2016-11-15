<?php

namespace app\modules\user\controllers\frontend;

use Yii;
use yii\captcha\CaptchaAction;
use app\modules\frontend\components\Controller;
use app\modules\user\models\UserRegistration;
use app\modules\user\models\LoginForm;
use app\modules\user\models\User;
use app\modules\user\models\UserService;

class DefaultController extends Controller
{

    public function actions()
    {
        return [
            'captcha' => [
                'class' => CaptchaAction::className(),
            ],
        ];
    }

	
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
		$model = new UserRegistration();
		$model->scenario = UserRegistration::SCENARIO_INSERT;
		
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

	public function actionPersonal($id)
    {
        $model = User::findOne($id);
        $modelService = new UserService($model);
        /**
         * @todo
         * если указать id лубого пользователя, он будет доступен
         */
        $modelService->setModelScenario(User::SCENARIO_UPDATE);

        if ($modelService->load(Yii::$app->request->post())) {

            $modelService->save();
        }

        return $this->render('personal', $modelService->getData());
    }
}
