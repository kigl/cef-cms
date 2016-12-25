<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 24.12.2016
 * Time: 21:11
 */

namespace app\modules\shop\components;


interface CartInterface
{
    public function add($productId, $coun);

    public function delete($productId);

    public function deleteAll();
}