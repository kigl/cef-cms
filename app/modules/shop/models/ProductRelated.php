<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_product_related".
 *
 * @property integer $product_id
 * @property integer $product_related_id
 */
class ProductRelated extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_shop_product_related';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_related_id'], 'integer'],
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
}
