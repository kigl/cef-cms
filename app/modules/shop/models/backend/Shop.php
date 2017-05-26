<?php
/**
 * Class Shop
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\shop\Module;

class Shop extends \app\modules\shop\models\Shop
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['group_on_page', 'product_on_page'], 'default', 'value' => Module::DEFAULT_ITEM_ON_PAGE],
            [['template', 'template_group', 'template_product'], 'default', 'value' => Module::DEFAULT_TEMPLATE_NAME],
            [
                [
                    'max_width_image_preview_group',
                    'max_height_image_preview_group',
                    'max_width_image_group',
                    'max_height_image_group',
                    'max_width_image_product',
                    'max_height_image_product',
                ],
                'default',
                'value' => Module::MAX_WIDTH_HEIGHT_IMAGE
            ],
            [['sorting_type_group', 'sorting_type_product'], 'default', 'value' => SORT_ASC],
            [['sorting_field_group', 'sorting_field_product'], 'default', 'value' => Module::DEFAULT_SORTING_FIELD],
        ]);
    }

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
    }
}