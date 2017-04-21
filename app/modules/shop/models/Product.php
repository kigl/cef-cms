<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $group_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $sku
 * @property string $price
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Product extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCK = 0;

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
            [['name'], 'required'],
            [['group_id', 'sku', 'status', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['code', 'name', 'description', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'sku' => Yii::t('app', 'Depot'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('shop', 'User id'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'imageUpload' => Yii::t('app', 'Upload images'),
        ];
    }

    /**
     * @return array
     */
    public function getListStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
        ];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getStatus($status)
    {
        return $this->getListStatus()[$status];
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
