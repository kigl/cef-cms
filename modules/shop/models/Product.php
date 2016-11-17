<?php

namespace app\modules\shop\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\core\db\ActiveRecord;
use app\core\behaviors\GenerateAlias;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
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
    const STATUS_NOT_AVAIlABLE = 2;

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
            [['content'], 'string'],
            [['price'], 'number'],
            [['create_time', 'update_time'], 'safe'],
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
            'id' => Yii::t('shop', 'Id'),
            'group_id' => Yii::t('shop', 'Group id'),
            'code' => Yii::t('shop', 'Code'),
            'name' => Yii::t('shop', 'Name'),
            'description' => Yii::t('shop', 'Description'),
            'content' => Yii::t('shop', 'Content'),
            'sku' => Yii::t('shop', 'Depot'),
            'price' => Yii::t('shop', 'Price'),
            'status' => Yii::t('shop', 'Status'),
            'user_id' => Yii::t('shop', 'User id'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'imageUpload' => Yii::t('shop', 'Image upload'),
            'groupName' => Yii::t('shop', 'Group name'),
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
        ];
    }

    /**
     * @return array
     */
    public function getListStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('shop', 'Status active'),
            self::STATUS_BLOCK => Yii::t('shop', 'Status block'),
            self::STATUS_NOT_AVAIlABLE => Yii::t('shop', 'Status not available'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProperty()
    {
        return $this->hasMany(ProductProperty::className(), ['product_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsModification()
    {
       return $this->hasMany(ProductModification::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentProductModification()
    {
        return $this->hasOne(ProductModification::className(), ['product_modification_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    public function getListProductInGroup()
    {
        return self::find()->where('group_id = :group', ['group' => $this->group_id])->select(['name', 'id'])->indexBy('id')->column();
    }
}
