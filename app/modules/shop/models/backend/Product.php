<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;
use app\core\behaviors\UserId;

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
class Product extends \app\modules\shop\models\Product
{
    public $imageUpload;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['price', 'sku'], 'default', 'value' => 0],
            ['imageUpload', 'image', 'maxFiles' => 5],
        ]);
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
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ];
    }

    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function getProperties()
    {
        return $this->hasMany(ProductProperty::className(), ['product_id' => 'id'])
            ->indexBy('property_id');
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

}
