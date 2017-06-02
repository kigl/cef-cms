<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\core\behaviors\file\ActionImage;

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
    const STATUS_DEFAULT = 0;

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
            [['product_id'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['alt'], 'string', 'max' => 255],
            ['name', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('shop', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'deleteKey' => Yii::t('app', 'Delete image'),
            'alt' => Yii::t('app', 'Alt'),
            'create_time' => Yii::t('app', 'Create time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => ActionImage::className(),
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/product',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/product',
                'attribute' => 'name',
            ],
        ];
    }
}
