<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\informationsystem\models\Informationsystem;

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
}