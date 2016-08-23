<?php 

namespace app\modules\main\controllers\backend;

use Yii;
use app\modules\main\models\Module;
use yii\data\ActiveDataProvider;

class ModuleController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'create' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model' => '\app\modules\main\models\Module',
			],
			'update' => [
				'class' => 'app\modules\main\components\actions\UpdateAction',
				'model' => '\app\modules\main\models\Module',
			],
			'delete' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model' => '\app\modules\main\models\Module',
			],
		];
	}

	public function actionManager()
	{
		$dataProvider = new ActiveDataProvider([
				'query' => Module::find(),
				'pagination' => [
					'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
				],
			]);

		return $this->render('manager', ['dataProvider' => $dataProvider]);
	}
}