<?php

namespace app\modules\shop\models\backend;


use app\core\behaviors\UserId;
use app\modules\users\models\User;

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
