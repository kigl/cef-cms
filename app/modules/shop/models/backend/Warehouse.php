<?php
/**
 * Class Warehouse
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class Warehouse extends \app\modules\shop\models\Warehouse
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['shop_id', 'name'], 'required'],
        ]);
    }
}