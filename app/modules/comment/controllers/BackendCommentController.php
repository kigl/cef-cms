<?php
/**
 * Class DefaultController
 * @package app\modules\reviews\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\backend\actions\Delete;
use app\modules\backend\actions\View;
use app\modules\comment\models\backend\Comment;
use app\modules\backend\actions\EditAttribute;

class BackendCommentController extends Controller
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
                ->with('user')
                ->where(['site_id' => Yii::$app->site->getId()])
        ]);

        return $this->render('manager', [
            'data' => [
                'dataProvider' => $dataProvider,
            ]
        ]);
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {

            Comment::deleteAll(['id' => $keys]);

            return true;
        }

        return false;
    }
}