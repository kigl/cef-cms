<?php

namespace app\modules\shop\models;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_product_related".
 *
 * @property integer $product_id
 * @property integer $product_related_id
 */
class ProductModification extends \app\modules\shop\models\base\ProductModification
{
    protected static $_productModification;

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_modification_id']);
    }
}
