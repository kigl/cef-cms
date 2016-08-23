<?php 

namespace app\modules\main\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\modules\main\models\Setting;
use app\modules\main\models\Module;

class SettingController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'create' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model' => '\app\modules\main\models\Setting',
			],
			'delete' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model' => '\app\modules\main\models\Setting',
			],
			'update' => [
				'class' => 'app\modules\main\components\actions\UpdateAction',
				'model' => '\app\modules\main\models\Setting',				
			],
		];
	}

	public function actionManager()
	{
		$dataProvider = new ActiveDataProvider([
				'query' => Setting::find(),
				'pagination' => [
					'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
				],
			]);

		return $this->render('manager', ['dataProvider' => $dataProvider]);
	}
	
	public function actionModule($id)
	{	
		// получаем массив объектов
		$model = Setting::getModuleSetting($id);
	
		if ($data = Yii::$app->request->post('Setting')) {
			foreach ($model as $setting) {
				foreach ($data as $post) {
					if ($setting->id == $post['id']) {
						$setting->value = $post['value'];
						$setting->save();
					}
				}
			}
		}
		
		return $this->render('module', [
						'model' => $model,
						'module' => Module::findOne($id)]);
	}
}