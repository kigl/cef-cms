<?php

namespace kigl\cef\module\shop\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kigl\cef\core\db\ActiveRecord;
use kigl\cef\core\behaviors\GenerateAlias;
use kigl\cef\core\behaviors\UserId;
use kigl\cef\module\user\models\User;

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

    public $imageUpload;

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
            ['parent_id', 'exist', 'targetAttribute' => 'id'],
            [['content'], 'string'],
            [['price', 'sku'], 'default', 'value' => 0],
            [['price'], 'number'],
            [['code', 'name', 'description', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['imageUpload', 'image', 'maxFiles' => 5],
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

    public function behaviors()
    {
        return [
            [
                'class' => GenerateAlias::className(),
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => UserId::className(),
                'attribute' => 'user_id',
            ],
            [
                'class' => 'kigl\cef\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ];
    }

    public static function find()
    {
        return new ProductQuery(get_called_class());
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
    public function getStatus($key)
    {
        return ArrayHelper::getValue($this->getListStatus(), $key);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
    public function getSubProducts()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    public function getMainImage()
    {
        return $this->hasOne(Image::className(), ['product_id' => 'id'])
            ->where(['status' => Image::STATUS_MAIN]);
    }

    /**
     * @todo функция должна находиться в сервисе представления
     * @param string $route
     * @return string
     */
    public function getUrl($route = "/shop/product/view")
    {
        return Url::to([$route, 'id' => $this->id, 'alias' => $this->alias]);
    }

    public function getModelItems()
    {
        return self::find()
            ->where(['parent_id' => null])
            ->all();
    }

    public function getModelItemUrl()
    {
        return Url::to(['/shop/product/view', 'id' => $this->id, 'alias' => $this->alias]);
    }
}
