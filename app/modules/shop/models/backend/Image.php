<?php

namespace app\modules\shop\models\backend;

use Yii;
use app\core\db\ActiveRecord;
use app\core\behaviors\file\ActionImage;
use yii\helpers\ArrayHelper;

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
class Image extends \app\modules\shop\models\Image
{
    const POST_NAME_STATUS = 'imageStatus';

    public $deleteKey;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['deleteKey', 'integer'],
        ]);
    }
}
