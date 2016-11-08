<?php

namespace app\modules\shop\models;

use Yii;
use app\core\db\ActiveRecord;

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
class Image extends ActiveRecord
{
    const STATUS_MAIN = 1;
    const POST_STATUS_NAME = 'imageStatus';

    public $deleteKey;

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
                'class' => 'app\core\components\behaviors\file\ImageUpload',
                'attribute' => 'name',
                'path' => Yii::$app->getModule('shop')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('shop')->getPublicPathUrl() . '/images',
            ],
        ];
    }
}
