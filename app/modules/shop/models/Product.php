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
 * @property integer $producer_id
 * @property string $vendor_code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $weight
 * @property integer $sku
 * @property string $price
 * @property integer $discount
 * @property integer $length
 * @property integer $width
 * @property integer $height
 * @property integer $active
 * @property integer $sorting
 * @property integer $user_id
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
            [['shop_id', 'name'], 'required'],
            [['shop_id', 'group_id', 'producer_id', 'sku', 'active', 'sorting', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['weight', 'price', 'discount', 'length', 'width', 'height'], 'number'],
            [
                ['vendor_code', 'name', 'description', 'alias', 'meta_title', 'meta_description', 'meta_keyword'],
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
            'group_id' => Yii::t('shop', 'Group id'),
            'shop_id' => Yii::t('shop', 'Shop ID'),
            'producer_id' => Yii::t('shop', 'Producer ID'),
            'vendor_code' => Yii::t('app', 'Vendor code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'weight' => Yii::t('app', 'Weight'),
            'sku' => Yii::t('app', 'Depot'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('shop', 'Discount'),
            'length' => Yii::t('app', 'Length'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'active' => Yii::t('app', 'Active'),
            'sorting' => Yii::t('app', 'Sorting'),
            'user_id' => Yii::t('shop', 'User id'),
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
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(ProductProperty::className(), ['product_id' => 'id'])
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
}
