<?php

namespace app\modules\article\controllers\backend;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\article\models\Article;
use app\modules\article\models\ArticleSearch;
use vova07\imperavi\actions\GetAction;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends \app\modules\main\components\controllers\BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\modules\main\components\actions\CreateAction',
                'model' => '\app\modules\article\models\Article',
            ],
            'update' => [
                'class' => 'app\modules\main\components\actions\UpdateAction',
                'model' => '\app\modules\article\models\Article',
            ],
            'delete' => [
                'class' => 'app\modules\main\components\actions\DeleteAction',
                'model' => 'app\modules\article\models\Article',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionManager()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('manager', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Article does not exist.');
        }
    }
}
