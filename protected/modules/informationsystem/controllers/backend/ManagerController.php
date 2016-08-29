<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\informationsystem\models\Informationsystem;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\InformationsystemGroup as Group;

class ManagerController extends \app\modules\main\components\controllers\BackendController
{
	public function actionSystem()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Informationsystem::find(),
			'pagination' => [
				'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
			],
		]);
		
		return $this->render('system', ['dataProvider' => $dataProvider]);
	}
	
	public function actionItem($informationsystem_id)
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Item::find(),
			'pagination' => [
				'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
			],
		]);
		
		return $this->render('item', ['dataProvider' => $dataProvider]);
	}
	
	public function actionGroup($informationsystem_id, $group_id = 0)
	{
		$dataProvider = new ActiveDataProvider([
				'query' => Group::find()->where('parent_id = :parent_id')->params([':parent_id' => $group_id]),
				'pagination' => [
					'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
				],
		]);
		
		return $this->render('group', ['dataProvider' => $dataProvider]);
	}
}
