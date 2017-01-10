<?php

namespace app\modules\user\controllers\frontend;

use app\modules\user\service\frontend\UserViewService;
use Yii;
use yii\captcha\CaptchaAction;
use app\modules\frontend\components\Controller;
use app\modules\user\models\UserRegistration;
use app\modules\user\models\LoginForm;
use app\modules\user\service\frontend\UserModelService;
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

		if (Yii::$app->request->isAjax) {
            return $this->renderAjax('login', ['model' => $model]);
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
			return $this->renderAjax('registration', ['model' => $model]);
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
        $modelService = new UserModelService();
        $modelService->actionPersonal([
            'post' => Yii::$app->request->post(),
            'id' => Yii::$app->user->getId(),
        ]);

        $viewService = (new UserViewService())->setData($modelService->getData());

        return $this->render('personal', ['data' => $viewService]);
    }
}
