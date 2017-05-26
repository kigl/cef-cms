<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;
use app\core\behaviors\UserId;

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
