<?php
/**
 * Class Shop
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\pages\models\Page;
use app\modules\infosystems\models\Infosystem;
use app\modules\shop\Module;

class Shop extends \app\modules\shop\models\Shop
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['code', 'name'], 'required'],
            ['code', 'match', 'pattern' => '/^[a-z]+$/'],
            [
                'code',
                'unique',
                'targetClass' => Page::className(),
                'targetAttribute' => 'alias',
            ],
            [
                'code',
                'unique',
                'targetClass' => Infosystem::className(),
                'targetAttribute' => 'code',
            ],
            ['image', 'image'],
            ['code', 'compare', 'compareValue' => 'shop', 'operator' => '!='],
            [['group_on_page', 'product_on_page'], 'default', 'value' => Module::DEFAULT_ITEM_ON_PAGE],
            [['template', 'template_group', 'template_product'], 'default', 'value' => Module::DEFAULT_TEMPLATE_NAME],
            [
                [
                    'group_image_preview_max_width',
                    'group_image_preview_max_height',
                    'group_image_max_width',
                    'group_image_max_height',
                    'product_image_preview_max_width',
                    'product_image_preview_max_height',
                    'product_image_max_width',
                    'product_image_max_height',
                ],
                'default',
                'value' => Module::MAX_WIDTH_HEIGHT_IMAGE
            ],
            [['group_sorting_type', 'product_sorting_type'], 'default', 'value' => SORT_ASC],
            [['group_sorting_field', 'product_sorting_field'], 'default', 'value' => Module::DEFAULT_SORTING_FIELD],
        ]);
    }

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
    }
}