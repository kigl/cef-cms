<?php 

namespace app\modules\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\modules\admin\models\Setting;

class SettingController extends \app\modules\admin\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'create' => [
				'class' => 'app\components\actions\Create',
				'model' => '\app\modules\admin\models\Setting',
			],
			'delete' => [
				'class' => 'app\components\actions\Delete',
				'model' => '\app\modules\admin\models\Setting',
			],
			'update' => [
				'class' => 'app\components\actions\Update',
				'model' => '\app\modules\admin\models\Setting',				
			],
		];
	}

	public function actionManager()
	{	
		$dataProvider = new ActiveDataProvider([
				'query' => Setting::find(),
				'pagination' => [
					'pageSize' => $this->module->itemsPerPage,
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