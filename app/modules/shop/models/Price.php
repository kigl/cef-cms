<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_price}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $name
 * @property string $description
 *
 * @property Shop $shop
 * @property PriceProduct[] $shopPriceProducts
 */
class Price extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopPriceProducts()
    {
        return $this->hasMany(PriceProduct::className(), ['price_id' => 'id']);
    }
}
