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
class Image extends \app\modules\shop\models\base\Image
{
    const STATUS_MAIN = 1;
    const STATUS_DEFAULT = 0;
    const POST_STATUS_NAME = 'imageStatus';

    public $deleteKey;

    public function behaviors()
    {
        return [
            [
                'class' => 'app\core\behaviors\file\UploadImage',
                'attribute' => 'name',
                'path' => Yii::$app->getModule('shop')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('shop')->getPublicPathUrl() . '/images',
            ],
        ];
    }
}
