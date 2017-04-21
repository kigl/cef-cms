<?php

namespace app\modules\shop\models\backend;


/**
 * This is the model class for table "{{%shop_order_item}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property double $qty
 * @property double $price
 *
 * @property Order $order
 */
class OrderItem extends \app\modules\shop\models\OrderItem
{
}
