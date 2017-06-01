<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\modules\users\models\User;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $group_id
 * @property integer $shop_id
 * @property integer $active
 * @property integer $sorting
 * @property string $code
 * @property string $vendor_code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $measure_id
 * @property number $weight
 * @property number $length
 * @property number $width
 * @property number $height
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 */
class Product extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'group_id', 'active', 'sorting', 'measure_id'], 'integer'],
            [['content'], 'string'],
            [['weight', 'length', 'width', 'height'], 'number'],
            [
                [
                    'code',
                    'vendor_code',
                    'name',
                    'description',
                    'alias',
                    'meta_title',
                    'meta_description',
                    'meta_keyword'
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('shop', 'Product parent id'),
            'group_id' => Yii::t('app', 'Group id'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'active' => Yii::t('app', 'Active'),
            'sorting' => Yii::t('app', 'Sorting'),
            'code' => Yii::t('app', 'Code'),
            'vendor_code' => Yii::t('shop', 'Vendor code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'measure_id' => Yii::t('shop', 'Measure ID'),
            'weight' => Yii::t('app', 'Weight'),
            'length' => Yii::t('app', 'Length'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'meta_keyword' => Yii::t('app', 'Meta keywords'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'imageUpload' => Yii::t('app', 'Upload images'),
        ];
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(PropertyProduct::className(), ['product_id' => 'id'])
            ->indexBy('property_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductModifications()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    /*
     * @todo
     * продумать
     */
    public function getMainImage()
    {
        return $this->hasOne(Image::className(), ['product_id' => 'id'])
            ->where(['status' => Image::STATUS_MAIN]);
    }

    public function getWarehouseProduct()
    {
        return $this->hasMany(WarehouseProduct::className(), ['product_id' => 'id']);
    }

    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }

    public function getPacking()
    {
        return $this->hasMany(Packing::className(), ['product_id' => 'id']);
    }

    public function getPriceProduct()
    {
        return $this->hasMany(PriceProduct::className(), ['product_id' => 'id']);
    }
}
