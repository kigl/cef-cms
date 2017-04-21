<?php

namespace app\modules\page\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\page\models\backend\Page;
use vova07\imperavi\actions\GetAction;

class BackendPageController extends BackendController
{

    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\modules\backend\actions\Create',
                'modelClass' => Page::class,
            ],
            'update' => [
                'class' => 'app\modules\backend\actions\Update',
                'modelClass' => Page::class,
            ],
            'delete' => [
                'class' => 'app\modules\backend\actions\Delete',
                'modelClass' => Page::class,
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::getAlias('@web/public/uploads/page'),
                'path' => Yii::getAlias('@webroot/public/uploads/page'),
                'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::getAlias('@web/public/uploads/page'),
                'path' => Yii::getAlias('@webroot/public/uploads/page'),
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
