<?php

namespace app\modules\shop\models\backend;


/**
 * This is the model class for table "mn_shop_order_field_relation".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $field_id
 *
 * @property OrderField $field
 * @property Order $order
 */
class OrderFieldRelation extends \app\modules\shop\models\OrderFieldRelation
{
}
