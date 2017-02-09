<?php

namespace app\modules\user\controllers\frontend;


use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\modules\user\service\frontend\UserViewService;
use app\modules\frontend\components\Controller;
use app\modules\user\models\forms\LoginForm;
use app\modules\user\service\frontend\UserModelService;

class DefaultController extends Controller
{

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
                        'actions' => ['login', 'logout', 'registration', 'captcha', 'password-restore'],
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
	    $modelService = Yii::createObject(UserModelService::class);
	    $modelService->actionRegistration(Yii::$app->request->post());

	    $viewService = (new UserViewService())->setData($modelService->getData());
		
		if (Yii::$app->user->isGuest) {
			if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_VALIDATE)) {
				return $this->goBack();
			}
			return $this->renderAjax('registration', ['data' => $viewService]);
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
		$modelService = Yii::createObject(UserModelService::class);
        $modelService->actionPersonal([
            'post' => Yii::$app->request->post(),
            'id' => Yii::$app->user->getId(),
        ]);

        $viewService = (new UserViewService())->setData($modelService->getData());

        return $this->render('personal', ['data' => $viewService]);
    }

    public function actionPasswordRestore()
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->actionPasswordRestore(Yii::$app->request->post());

        $viewService = (new UserViewService())->setData($modelService->getData());

        return $this->render('passwordRestore', ['data' => $viewService]);
    }
}
