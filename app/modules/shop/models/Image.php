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
    const STATUS_MAIN = 1;

    public $deleteKey;
    protected static $_images;

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
            [['product_id', 'status', 'deleteKey'], 'integer'],
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
            'deleteKey' => Yii::t('shop', 'Delete key'),
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

    public static function upload(Product $model, $attribute)
    {
        $uploadedImages = UploadedFile::getInstances($model, $attribute);

        $c = 0;
        foreach ($uploadedImages as $upload) {
            $c++;
            $image = new Image();
            $image->product_id = $model->id;
            $image->name = $upload;
            if (!self::$_images and $c == 1) {
                $image->status = self::STATUS_MAIN;
            }
            $image->save(false);
        }
    }

    public static function initImages(Product $model)
    {
        self::$_images = $model->getImages()->indexBy('id')->all();

        return self::$_images;
    }

    public static function process()
    {
        $imageStatus = Yii::$app->request->post('imageStatus');

        if (is_array(self::$_images)) {
            foreach (self::$_images as $image) {
                if (!empty($image->deleteKey)) {
                    $image->delete();
                } else {
                    $image->status = ($imageStatus == $image->id)? 1 : null;
                    $image->save();
                }
            }
        }
    }
}
