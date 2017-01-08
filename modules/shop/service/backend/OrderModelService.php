<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:09
 */

namespace app\modules\shop\service\backend;


use app\core\service\ModelService;
use app\modules\shop\models\base\OrderField;
use yii\data\ActiveDataProvider;

class OrderModelService extends ModelService
{
    public function actionFieldManager()
    {
        $query = OrderField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setData([
            'fieldDataProvider' => $dataProvider,
        ]);
    }
}