<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "{{%shop}}".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $currency_id
 * @property integer $weight_measure_id
 * @property integer $size_packing_measure_id
 * @property integer $group_on_page
 * @property integer $product_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_product
 * @property integer $group_image_preview_max_width
 * @property integer $group_image_preview_max_height
 * @property integer $group_image_max_width
 * @property integer $group_image_max_height
 * @property integer $product_image_max_width
 * @property integer $product_image_max_height
 * @property integer $group_sorting_type
 * @property string $group_sorting_field
 * @property string $group_sorting_list_field
 * @property integer $product_sorting_type
 * @property string $product_sorting_field
 * @property string $product_sorting_list_field
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 *
 * @property Measure $productSizeMeasure
 * @property Measure $productWeightMeasure
 * @property Price[] $shopPrices
 * @property Warehouse[] $shopWarehouses
 */
class Shop extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'site_id',
                    'currency_id',
                    'weight_measure_id',
                    'size_packing_measure_id',
                    'group_on_page',
                    'product_on_page',
                    'group_image_preview_max_width',
                    'group_image_preview_max_height',
                    'group_image_max_width',
                    'group_image_max_height',
                    'product_image_max_width',
                    'product_image_max_height',
                    'group_sorting_type',
                    'product_sorting_type',
                ],
                'integer'
            ],
            [['content'], 'string'],
            [
                [
                    'code',
                    'name',
                    'template',
                    'template_group',
                    'template_product',
                    'group_sorting_field',
                    'group_sorting_list_field',
                    'product_sorting_field',
                    'product_sorting_list_field',
                    'meta_title',
                    'meta_description',
                    'meta_keyword'
                ],
                'string',
                'max' => 255
            ],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_id' => Yii::t('app', 'Site ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'currency_id' => Yii::t('shop', 'Currency'),
            'weight_measure_id' => Yii::t('shop', 'Product weight measure'),
            'size_packing_measure_id' => Yii::t('shop', 'Size packing measure'),
            'group_on_page' => Yii::t('shop', 'Group on page'),
            'product_on_page' => Yii::t('shop', 'Product on page'),
            'template' => Yii::t('app', 'Template'),
            'template_group' => Yii::t('shop', 'Template group'),
            'template_product' => Yii::t('shop', 'Template product'),
            'group_image_preview_max_width' => Yii::t('shop', 'Group image preview max width'),
            'group_image_preview_max_height' => Yii::t('shop', 'Group image preview max height'),
            'group_image_max_width' => Yii::t('shop', 'Group image max width'),
            'group_image_max_height' => Yii::t('shop', 'Group image max height'),
            'product_image_max_width' => Yii::t('shop', 'Product image max width'),
            'product_image_max_height' => Yii::t('shop', 'Product image max height'),
            'group_sorting_type' => Yii::t('shop', 'Group sorting type'),
            'group_sorting_field' => Yii::t('shop', 'Group sorting field'),
            'group_sorting_list_field' => Yii::t('shop', 'Group sorting list field'),
            'product_sorting_type' => Yii::t('shop', 'Product sorting type'),
            'product_sorting_field' => Yii::t('shop', 'Product sorting field'),
            'product_sorting_list_field' => Yii::t('shop', 'Product sorting list field'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'meta_keyword' => Yii::t('app', 'Meta keyword'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image',
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/shop/images',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/shop/images',
            ],
        ];
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['shop_id' => 'id']);
    }

    public function getWeightMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'weight_measure_id']);
    }

    public function getSizePackingMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'size_packing_measure_id']);
    }

    public function getGroupSortingFieldList()
    {
        return array_values((array)unserialize($this->group_sorting_list_field));
    }

    public function getProductSortingFieldList()
    {
        return array_values((array)unserialize($this->product_sorting_list_field));
    }
}
