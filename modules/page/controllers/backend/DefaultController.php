<?php

namespace app\modules\page\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\page\components\Controller;
use app\modules\page\models\Page;
use vova07\imperavi\actions\GetAction;

class DefaultController extends Controller
{

    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\core\actions\Create',
                'model' => '\app\modules\page\models\Page',
            ],
            'update' => [
                'class' => 'app\core\actions\Update',
                'model' => '\app\modules\page\models\Page',
            ],
            'delete' => [
                'class' => 'app\core\actions\Delete',
                'model' => '\app\modules\page\models\Page',
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::$app->controller->module->getPublicPath() . '/images',
                'path' => Yii::$app->controller->module->getPublicPathUrl() . '/images',
                'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::$app->controller->module->getPublicPath() . '/images',
                'path' => Yii::$app->controller->module->getPublicPathUrl() . '/images',
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