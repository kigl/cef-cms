<?php
/**
 * Class WarehouseProduct
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class WarehouseProduct extends \app\modules\shop\models\WarehouseProduct
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['warehouse_id', 'product_id', 'value'], 'required'],
        ]);
    }
}