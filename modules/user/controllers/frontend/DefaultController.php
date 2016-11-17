<?php

namespace app\modules\user\controllers\frontend;

use Yii;
use yii\captcha\CaptchaAction;
use app\modules\frontend\components\Controller;
use app\modules\user\models\UserRegistration;
use app\modules\user\models\LoginForm;
use app\modules\user\models\User;
use app\modules\user\models\UserService;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

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

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'accessControl' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['personal'],
                        'roles' => ['register'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'logout', 'registration', 'captcha'],
                        'roles' => ['guest'],
                    ],
                ],
            ],
        ]);
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

	public function actionPersonal()
    {
        $model = User::findOne(Yii::$app->user->getId());
        $modelService = new UserService($model);
        $modelService->setModelScenario(User::SCENARIO_UPDATE);

        if ($modelService->load(Yii::$app->request->post())) {

            $modelService->save();
        }

        return $this->render('personal', $modelService->getData());
    }
}
