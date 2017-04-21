<?php
/**
 * User: ARstudio
 * Date: 27.12.2016
 * Time: 13:05
 */

namespace app\modules\shop\components\cart;


interface CartInterface
{
    public function add($productId, $qty);

    public function delete($productId);

    public function clear();
}