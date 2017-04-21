<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:09
 */

namespace app\modules\shop\models\backend\service;


use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\backend\Order;

class OrderModelService extends ModelService
{
    public function actionManager()
    {
        $query = Order::find()
         ->where("status != :status", [':status' => Order::STATUS_NOT_ACCEPTED]);

        $query->with(['user']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ],
                'attributes' => ['id', 'create_time'],
            ],
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Order::findOne($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getItems(),
        ]);

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}