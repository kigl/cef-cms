<?php

namespace app\modules\shop\models\backend;


/**
 * This is the model class for table "{{%shop_cart_item}}".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $qty
 * @property double $price
 *
 * @property Product $product
 * @property Cart $cart
 */
class CartItem extends \app\modules\shop\models\CartItem
{
}
