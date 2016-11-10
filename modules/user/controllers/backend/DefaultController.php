<?php

namespace app\modules\user\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\user\components\Controller;
use app\modules\user\models\UserService;
use app\modules\user\models\User;

class DefaultController extends Controller
{

	public function actions()
	{
		return [
			'delete' => [
				'class' => 'app\core\actions\Delete',
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

	public function actionCreate()
    {
        $model = new User();
        $modelService = new UserService($model);
        $modelService->setModelScenario(User::SCENARIO_INSERT);

        if ($modelService->load(Yii::$app->request->post()) and $modelService->save()) {

            return $this->redirect(['default/manager']);
        }

        return $this->render('create', $modelService->getData());
     }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        $modelService = new UserService($model);
        $modelService->setModelScenario(User::SCENARIO_UPDATE);

        if ($modelService->load(Yii::$app->request->post())) {
            $modelService->save();

            return $this->redirect(['default/manager']);
        }

        return $this->render('update', $modelService->getData());
    }
}
