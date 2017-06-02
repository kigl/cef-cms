<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\core\behaviors\file\ActionImage;

/**
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $shop_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_preview
 * @property string $image
 * @property integer $sorting
 * @property integer $active
 * @property integer $user_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $create_time
 * @property string $update_time
 */
class ProductGroup extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'name'], 'required'],
            [['parent_id','shop_id','active', 'sorting', 'user_id'], 'integer'],
            [['content'], 'string'],
            [
                ['name', 'description', 'alias', 'meta_title', 'meta_description'],
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
            'parent_id' => Yii::t('app', 'Parent id'),
            'shop_id' => Yii::t('shop', 'Shop ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image'),
            'image' => Yii::t('app', 'Image'),
            'sorting' => Yii::t('app', 'sorting'),
            'active' => Yii::t('app', 'Active'),
            'user_id' => Yii::t('app', 'User ID'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => ActionImage::className(),
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/group',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/group',
                'attribute' => 'image_preview',
            ],
            'image' => [
                'class' => ActionImage::className(),
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/group',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/group',
                'attribute' => 'image',
            ],
        ];
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['group_id' => 'id']);
    }

    public function getSubGroups()
    {
        return $this->hasMany(static::className(), ['parent_id' => 'id']);
    }
}
