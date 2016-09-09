<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\InformationsystemItemSearch as ItemSearch;

class ManagerController extends \app\modules\main\components\controllers\BackendController
{
	public $defaultAction = 'system';
	
	public function actionSystem()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => System::find(),
			'pagination' => [
				'pageSize' => $this->module->itemsOnPage,
			],
		]);
		
		return $this->render('system', ['dataProvider' => $dataProvider]);
	}
	
	public function actionItem($informationsystem_id, $group_id = 0)
	{				
		$searchModel = new ItemSearch();
		$dataProvider = $searchModel->search($informationsystem_id, $group_id, Yii::$app->request->queryParams);
		
		return $this->render('item', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider, 
				'informationsystem_id' => $informationsystem_id,
				'breadcrumbs' => Item::buildBreadcrumbs($group_id, $informationsystem_id),
				]);
	}
}
