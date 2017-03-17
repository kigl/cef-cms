<?php
/**
 * Class DefaultController
 * @package app\modules\reviews\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kiglcef\module\comment\controllers\backend;


use yii\data\ActiveDataProvider;
use kigl\cef\backend\module\actions\Delete;
use kigl\cef\backend\module\actions\View;
use kigl\cef\module\comment\components\BackendController;
use kigl\cef\module\comment\models\Comment;
use kigl\cef\modulebackend\actions\EditAttribute;

class CommentController extends BackendController
{
    public function actions()
    {
        return [
            'edit-status' => [
                'class' => EditAttribute::class,
                'modelClass' => Comment::class,
                'attribute' => 'status',
            ],
            'view' => [
                'class' => View::class,
                'modelClass' => Comment::class,
            ],
            'delete' => [
                'class' => Delete::class,
                'modelClass' => Comment::class,
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find()
                ->with('user'),
        ]);

        return $this->render('manager', [
            'data' => [
                'dataProvider' => $dataProvider,
            ]
        ]);
    }
}