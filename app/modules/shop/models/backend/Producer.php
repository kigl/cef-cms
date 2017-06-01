<?php
/**
 * Class Producer
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;
use app\modules\shop\Module;

class Producer extends \app\modules\shop\models\Producer
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'required'],
            [['image_preview', 'image'], 'image'],
            ['sorting', 'default', 'value' => Module::DEFAULT_SORTING],
        ]);
    }
}