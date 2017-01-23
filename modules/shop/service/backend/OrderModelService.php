<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:09
 */

namespace app\modules\shop\service\backend;


use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\base\Order;

class OrderModelService extends ModelService
{
    public function actionManager()
    {
        $query = Order::find();

        $query->joinWith(['user']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }
}