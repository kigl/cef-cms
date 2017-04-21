<?php

namespace app\modules\menu\models\backend;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $name
 * @property string $url
 * @property integer $visible
 * @property integer $sorting
 * @property string $image
 * @property string $item_class
 * @property string $item_id
 * @property string $item_icon_class
 * @property string $link_class
 * @property string $link_id
 */
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
