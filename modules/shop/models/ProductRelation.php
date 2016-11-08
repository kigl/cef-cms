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
class ProductRelation extends ActiveRecord
{
    protected static $_productRelation;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_relation_id'], 'integer'],
            ['product_relation_id', 'compare', 'compareAttribute' => 'product_id', 'operator' => '!='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('shop', 'Product id'),
            'product_related_id' => Yii::t('shop', 'Product related id'),
        ];
    }

    public static function primaryKey()
    {
        return ['product_id', 'product_relation_id'];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_relation_id']);
    }

    public static function initRelation(Product $model)
    {
        self::$_productRelation = $model->getParentProductRelation()->one();

        if (!isset(self::$_productRelation)) {
            self::$_productRelation = new self();
        }

        return self::$_productRelation;
    }

    public static function saveRelation(Product $model)
    {
        if (!empty(self::$_productRelation->product_id)) {
            self::$_productRelation->product_relation_id = $model->id;
            self::$_productRelation->save();
        }
    }

}
