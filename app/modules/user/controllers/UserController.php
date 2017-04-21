<?php

namespace app\modules\user\controllers;


use Yii;
use yii\web\Controller;
use app\modules\user\models\service\UserModelService;

class UserController extends Controller
{

    public function actionLogin()
    {
        $modelService = Yii::createObject([
            'class' => UserModelService::className(),
            'data' => [
                'post' => Yii::$app->request->post(),
            ]
        ]);

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }

        if ($modelService->actionLogin()) {
            return $this->goBack();
        }

        return $this->render('login', ['data' => $modelService->getData()]);
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

        return $this->render('personal', ['data' => $modelService->getData()]);
    }

    public function actionPasswordRestore()
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->actionPasswordRestore(Yii::$app->request->post());

        $viewService = (new UserViewService())->setData($modelService->getData());

        return $this->render('passwordRestore', ['data' => $viewService]);
    }

    public function actionTest()
    {
        return $this->render('index');
    }
}
