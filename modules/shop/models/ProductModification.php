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
class ProductModification extends ActiveRecord
{
    protected static $_productModification;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_modification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_modification_id'], 'integer'],
            ['product_modification_id', 'compare', 'compareAttribute' => 'product_id', 'operator' => '!='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('shop', 'Product id'),
            'product_modification_id' => Yii::t('shop', 'Product modification id'),
        ];
    }

    public static function primaryKey()
    {
        return ['product_id', 'product_modification_id'];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_modification_id']);
    }
}
