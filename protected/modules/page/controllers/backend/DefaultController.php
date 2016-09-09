<?php

namespace app\modules\page\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\page\models\Page;
use vova07\imperavi\actions\GetAction;

class DefaultController extends \app\modules\main\components\controllers\BackendController
{
	
	public function actions()
	{
		return [
			'create' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model' => '\app\modules\page\models\Page',
			],
			'update' => [
				'class' => 'app\modules\main\components\actions\UpdateAction',
				'model' => '\app\modules\page\models\Page',
			],
			'delete' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model' => '\app\modules\page\models\Page',
			],
      'images-get' => [
        'class' => 'vova07\imperavi\actions\GetAction',
        'url' => Yii::$app->controller->module->getImagesPathUrl(),
        'path' => Yii::$app->controller->module->getImagesPath(),
        'type' => GetAction::TYPE_IMAGES,
    	],
      'image-upload' => [
        'class' => 'vova07\imperavi\actions\UploadAction',
        'url' => Yii::$app->controller->module->getImagesPathUrl(),
        'path' => Yii::$app->controller->module->getImagesPath(),
    	],
		];
	}
	
	public function actionManager()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Page::find(),
		]);
		
		return $this->render('manager', ['dataProvider' => $dataProvider]);	
	}
}