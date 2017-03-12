<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 12.03.2017
 * Time: 19:35
 */

namespace app\modules\service\controllers\backend\lists;


use app\modules\service\components\BackendController;
use app\modules\service\models\lists\Item;
use yii\data\ActiveDataProvider;

class ItemController extends BackendController
{
    public function actionManager($list_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['list_id' => $list_id])
        ]);

        return $this->render('manager', ['data' => [
            'dataProvider' => $dataProvider,
        ]]);
    }
}