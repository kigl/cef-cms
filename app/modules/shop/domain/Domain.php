<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 01.11.2016
 * Time: 10:04
 */

namespace app\modules\shop\domain;

use app\modules\shop\models\Product;


class Domain implements DomainInterface
{
    protected $_product;
    protected $_response;

    public function getModel()
    {
        return $this->_product;
    }

}