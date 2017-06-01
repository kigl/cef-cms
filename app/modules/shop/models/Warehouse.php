<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_warehouse}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $name
 * @property string $description
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $address
 *
 * @property Shop $shop
 * @property WarehouseProduct[] $shopWarehouseProducts
 */
class Warehouse extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_warehouse}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'country_id', 'region_id', 'city_id'], 'integer'],
            [['name', 'address'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
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
            'country_id' => Yii::t('app', 'Country ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'address' => Yii::t('app', 'Address'),
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
    public function getWarehouseProducts()
    {
        return $this->hasMany(WarehouseProduct::className(), ['warehouse_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->via('warehouseProducts');
    }
}
