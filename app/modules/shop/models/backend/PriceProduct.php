<?php
/**
 * Class PriceProduct
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class PriceProduct extends \app\modules\shop\models\PriceProduct
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['price_id', 'product_id', 'value'], 'required'],
        ]);
    }
}