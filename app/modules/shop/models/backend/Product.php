<?php

namespace app\modules\shop\models\backend;


use app\modules\shop\Module;
use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;
use app\core\behaviors\UserId;

class Product extends \app\modules\shop\models\Product
{
    public $imageUpload;
    public $test;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['price', 'discount', 'weight', 'length', 'width', 'height', 'sku'], 'default', 'value' => 0],
            [
                'imageUpload',
                'image',
                'maxFiles' => Module::MAX_UPLOAD_FILES,
                'maxWidth' => $this->shop->max_width_image_product,
                'maxHeight' => $this->shop->max_height_image_product
            ],
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
        return $this->hasMany(PropertyProduct::className(), ['product_id' => 'id'])
            ->indexBy('property_id');
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }
}
