<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\components\FrontendController;
use app\modules\shop\models\Group;
use yii\data\ActiveDataProvider;

class GroupController extends FrontendController
{
    public $layout = '@app/modules/shop/views/frontend/layouts/column_2';

    public function actionView($id)
    {
        $model = Group::find()
            ->where('id = :id', [':id' => $id])
            ->orWhere('alias = :alias', [':alias' => $id])
            ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProducts(),
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionList()
    {
        $model = Group::find()->all();

        return $this->render('list', ['model' => $model]);
    }
}