<?php

namespace app\modules\menu\models\backend;


use yii\helpers\ArrayHelper;

class Item extends \app\modules\menu\models\Item
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['sorting', 'default', 'value' => 500],
        ]);
    }
}
