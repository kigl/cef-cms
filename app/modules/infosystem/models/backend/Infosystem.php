<?php

namespace app\modules\infosystem\models\backend;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_infosystem".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $item_on_page
 * @property string $template_group
 * @property string $template_item
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Infosystem extends \app\modules\infosystem\models\Infosystem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['template_group', 'template_item'], 'default', 'value' => 'view'],
            ['item_on_page', 'default', 'value' => '30'],
        ]);
    }
}
