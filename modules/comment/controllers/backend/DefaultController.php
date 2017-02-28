<?php
/**
 * Class DefaultController
 * @package app\modules\reviews\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\controllers\backend;


use app\modules\comment\components\BackendController;
use app\modules\comment\models\Comment;
use yii\data\ActiveDataProvider;

class DefaultController extends BackendController
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find(),
        ]);

        return $this->render('manager', ['data' => [
            'dataProvider' => $dataProvider,
        ]]);
    }
}