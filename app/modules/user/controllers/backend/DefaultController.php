<?php

namespace app\modules\user\controllers\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BackendController;
use app\modules\user\models\User;

class DefaultController extends BackendController
{

	public function actions()
	{
		return [
			'delete' => [
				'class' => 'app\components\actions\Delete',
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
        $fieldRelation = $model->getInitField();
        $post = Yii::$app->request->post();

        if ($model->load($post) and $model->save() and Model::loadMultiple($fieldRelation, $post)) {
            $model->saveField($fieldRelation);

            return $this->redirect(['default/manager']);
        }

        return $this->render('create', [
            'model' => $model,
            'fieldRelation' => $fieldRelation,
        ]);
     }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        $fieldRelation = $model->getInitField();
        $post = Yii::$app->request->post();

        if ($model->load($post) and $model->save() and Model::loadMultiple($fieldRelation, $post)) {
            $model->saveField($fieldRelation);

            return $this->redirect(['default/manager']);
        }

        return $this->render('update', [
            'model' => $model,
            'fieldRelation' => $fieldRelation,
        ]);
    }
}
