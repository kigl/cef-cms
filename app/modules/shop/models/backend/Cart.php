<?php

namespace app\modules\shop\models\backend;

/**
 * This is the model class for table "{{%shop_cart}}".
 *
 * @property integer $id
 * @property integer $user_id
 *
 * @property User $user
 * @property CartItem[] $shopCartItems
 */
class Cart extends \app\modules\shop\models\Cart
{
}
