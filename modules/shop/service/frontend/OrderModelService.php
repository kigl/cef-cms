<?php
/**
 * Class OrderModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use app\modules\shop\models\base\Order;
use app\modules\shop\models\base\OrderField;
use app\core\service\ModelService;

class OrderModelService extends ModelService
{
    protected $field;

    public function actionIndex()
    {
        $this->model = Order::find()
            ->where('id = :id', [':id' => $this->getData('orderId')])
            ->with('fieldRelation')
            ->one();

        $this->init();
    }

    protected function init()
    {
        $this->initField();
    }

    protected function initField()
    {
        $field = $this->model->getFieldRelation()
            ->with('field')
            ->indexBy('field_id')
            ->all();

        $allProperty = OrderField::find()
            ->indexBy('id')
            ->all();
    }
}
