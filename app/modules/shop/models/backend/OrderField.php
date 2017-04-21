<?php

namespace app\modules\shop\models\backend;


/**
 * This is the model class for table "{{%shop_order_field}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property  integer $required
 *
 * @property OrderFieldRelation[] $shopOrderFieldRelations
 */
class OrderField extends \app\modules\shop\models\OrderField
{
}
