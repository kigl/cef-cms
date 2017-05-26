<?php

namespace app\modules\shop\models;

use Yii;

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
 * @property integer $group_on_page
 * @property integer $product_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_product
 * @property integer $max_width_image_preview_group
 * @property integer $max_height_image_preview_group
 * @property integer $max_width_image_group
 * @property integer $max_height_image_group
 * @property integer $max_width_image_product
 * @property integer $max_height_image_product
 * @property integer $sorting_type_group
 * @property string $sorting_field_group
 * @property string $sorting_list_field_group
 * @property integer $sorting_type_product
 * @property string $sorting_field_product
 * @property string $sorting_list_field_product
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 */
class Shop extends \yii\db\ActiveRecord
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
                    'code',
                    'name',
                    'sorting_list_field_group',
                    'sorting_list_field_product',
                ],
                'required'
            ],
            [
                [
                    'group_on_page',
                    'product_on_page',
                    'max_width_image_preview_group',
                    'max_height_image_preview_group',
                    'max_width_image_group',
                    'max_height_image_group',
                    'max_width_image_product',
                    'max_height_image_product',
                    'sorting_type_group',
                    'sorting_type_product'
                ],
                'integer'
            ],
            [['content'], 'string'],
            [
                [
                    'code',
                    'name',
                    'image',
                    'template',
                    'template_group',
                    'template_product',
                    'sorting_field_group',
                    'sorting_list_field_group',
                    'sorting_field_product',
                    'sorting_list_field_product',
                    'meta_title',
                    'meta_keyword',
                ],
                'string',
                'max' => 255
            ],
            [['description', 'meta_description'], 'string', 'max' => 500],
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
            'group_on_page' => Yii::t('app', 'Group on page'),
            'product_on_page' => Yii::t('shop', 'Product on page'),
            'template' => Yii::t('app', 'Template'),
            'template_group' => Yii::t('shop', 'Template group'),
            'template_product' => Yii::t('shop', 'Template product'),
            'max_width_image_preview_group' => Yii::t('shop', 'Max width image preview group'),
            'max_height_image_preview_group' => Yii::t('shop', 'Max height image preview group'),
            'max_width_image_group' => Yii::t('shop', 'Max width image group'),
            'max_height_image_group' => Yii::t('shop', 'Max height image group'),
            'max_width_image_product' => Yii::t('shop', 'Max width image product'),
            'max_height_image_product' => Yii::t('shop', 'Max height image product'),
            'sorting_type_group' => Yii::t('shop', 'Sorting type group'),
            'sorting_field_group' => Yii::t('shop', 'Sorting field group'),
            'sorting_list_field_group' => Yii::t('shop', 'Sorting list field group'),
            'sorting_type_product' => Yii::t('shop', 'Sorting type product'),
            'sorting_field_product' => Yii::t('shop', 'Sorting field product'),
            'sorting_list_field_product' => Yii::t('shop', 'Sorting list field product'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'meta_keyword' => Yii::t('app', 'Meta keywords'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }
}
