<?php
/**
 * Class DefaultController
 * @package app\modules\reviews\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\controllers\backend;


use yii\data\ActiveDataProvider;
use app\core\actions\Delete;
use app\core\actions\View;
use app\modules\comment\components\BackendController;
use app\modules\comment\models\Comment;
use app\core\actions\EditAttribute;

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