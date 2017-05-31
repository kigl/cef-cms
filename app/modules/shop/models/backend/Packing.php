<?php
/**
 * Class Packing
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class Packing extends \app\modules\shop\models\Packing
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['measure_id', 'product_id', 'name', 'value'], 'required'],
        ]);
    }
}