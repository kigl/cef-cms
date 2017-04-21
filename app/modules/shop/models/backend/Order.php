<?php

namespace app\modules\shop\models\backend;


use app\core\behaviors\UserId;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%shop_order}}".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 * @property number $sum
 *
 * @property Cart[] $shopCarts
 * @property User $user
 */
class Order extends \app\modules\shop\models\Order
{
    public function behaviors()
    {
        return [
            [
                'class' => UserId::class,
            ]
        ];
    }
}
