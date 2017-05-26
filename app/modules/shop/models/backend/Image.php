<?php

namespace app\modules\shop\models\backend;

use Yii;
use app\core\db\ActiveRecord;
use app\core\behaviors\file\ActionImage;
use yii\helpers\ArrayHelper;

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
