<?php

namespace app\modules\shop\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "mn_shop_product_image".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property integer $status
 * @property string $alt
 * @property string $create_time
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['name', 'alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'Id'),
            'product_id' => Yii::t('shop', 'Product id'),
            'name' => Yii::t('shop', 'Name'),
            'status' => Yii::t('shop', 'Status'),
            'alt' => Yii::t('shop', 'Alt'),
            'create_time' => Yii::t('app', 'Create time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'app\components\behaviors\file\ImageUpload',
                'attribute' => 'name',
                'path' => Yii::$app->getModule('shop')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('shop')->getPublicPathUrl() . '/images',
            ],
        ];
    }

    public static function uploadImages(Product $model, $attribute)
    {
        $uploadedImages = UploadedFile::getInstances($model, $attribute);

        foreach ($uploadedImages as $upload) {
            $image = new Image();
            $image->product_id = $model->id;
            $image->name = $upload;
            $image->save(false);
        }
    }
}
