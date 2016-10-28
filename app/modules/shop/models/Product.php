<?php

namespace app\modules\shop\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $depot
 * @property string $price
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Product extends \app\components\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCK = 0;
    const STATUS_NOT_AVAIlABLE = 2;

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
            [['group_id', 'depot', 'status', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['code', 'name', 'description', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
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
            'depot' => Yii::t('shop', 'Depot'),
            'price' => Yii::t('shop', 'Price'),
            'status' => Yii::t('shop', 'Status'),
            'user_id' => Yii::t('shop', 'User id'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
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
    public function getProductRelation()
    {
       return $this->hasMany(ProductRelation::className(), ['product_id' => 'id']);
    }

    public function getParentProductRelation()
    {
        return $this->hasOne(ProductRelation::className(), ['product_relation_id' => 'id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[] ProductProperty
     */
    public function getInitProperty()
    {
        $productProperty = $this->getProductProperty()->with('property')->indexBy('property_id')->all();
        $allProperty = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allProperty, $productProperty) as $property) {
            $productProperty[$property->id] = new ProductProperty();
            $productProperty[$property->id]->property_id = $property->id;
        }

        return $productProperty;
    }

    public function getListProductInGroup()
    {
        return self::find()->where('group_id = :group', ['group' => $this->group_id])->select(['name', 'id'])->indexBy('id')->column();
    }

    /**
     * @param ProductProperty array $properties
     */
    public function saveProperty($properties)
    {
        foreach ($properties as $property) {
            $property->product_id = $this->id;

            if (!empty($property->value) and $property->validate()) {
                $property->save(false);
            }
        }
    }

    public function getInitProductRelation()
    {
        $productRelation = $this->getParentProductRelation()->one();

        if (!isset($productRelation)) {
            $productRelation = new ProductRelation();
        }

        return $productRelation;
    }

    public function saveProductRelation($productRelation)
    {
        if (!empty($productRelation->product_id)) {
            $productRelation->product_relation_id = $this->id;
            $productRelation->save();
        }
    }
}
