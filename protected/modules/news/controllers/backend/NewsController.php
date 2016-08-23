<?php

namespace app\modules\news\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\news\models\NewsSearch;
use vova07\imperavi\actions\GetAction;

class NewsController extends \app\modules\main\components\controllers\BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\modules\main\components\actions\CreateAction',
                'model' => '\app\modules\News\models\News',
            ],
            'update' => [
                'class' => 'app\modules\main\components\actions\UpdateAction',
                'model' => '\app\modules\News\models\News',
            ],
            'delete' => [
                'class' => 'app\modules\main\components\actions\DeleteAction',
                'model' => 'app\modules\News\models\News',
            ],
	          'images-get' => [
	            'class' => 'vova07\imperavi\actions\GetAction',
	            'url' => Yii::$app->controller->module->getModuleImagesPathUrl(),
	            'path' => Yii::$app->controller->module->getModuleImagesPath(),
	            'type' => GetAction::TYPE_IMAGES,
	        	],
		        'image-upload' => [
	            'class' => 'vova07\imperavi\actions\UploadAction',
	            'url' => Yii::$app->controller->module->getModuleImagesPathUrl(),
	            'path' => Yii::$app->controller->module->getModuleImagesPath(),
	        	],
        ];
    }	
    
    public function actionManager()
    {
			$searchModel = new NewsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('manager', [
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider,
			]);
		}
}
