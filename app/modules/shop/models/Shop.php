<?php

namespace app\modules\shop\models;


use app\core\db\ActiveRecord;
use Yii;
use app\core\behaviors\UserId;

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
 * @property integer $product_weight_measure_id
 * @property integer $product_size_measure_id
 * @property integer $group_on_page
 * @property integer $product_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_product
 * @property integer $group_image_preview_max_width
 * @property integer $group_image_preview_max_height
 * @property integer $group_image_max_width
 * @property integer $group_image_max_height
 * @property integer $product_image_preview_max_width
 * @property integer $product_image_preview_max_height
 * @property integer $product_image_max_width
 * @property integer $product_image_max_height
 * @property integer $group_sorting_type
 * @property string $group_sorting_field
 * @property string $group_sorting_list_field
 * @property integer $product_sorting_type
 * @property string $product_sorting_field
 * @property string $product_sorting_list_field
 * @property integer $user_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 *
 * @property ShopMeasure $productSizeMeasure
 * @property ShopMeasure $productWeightMeasure
 * @property ShopPrice[] $shopPrices
 * @property ShopWarehouse[] $shopWarehouses
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
                    'product_weight_measure_id',
                    'product_size_measure_id',
                    'group_on_page',
                    'product_on_page',
                    'group_image_preview_max_width',
                    'group_image_preview_max_height',
                    'group_image_max_width',
                    'group_image_max_height',
                    'product_image_preview_max_width',
                    'product_image_preview_max_height',
                    'product_image_max_width',
                    'product_image_max_height',
                    'group_sorting_type',
                    'product_sorting_type',
                    'user_id'
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
            'product_weight_measure_id' => Yii::t('shop', 'Product Weight Measure ID'),
            'product_size_measure_id' => Yii::t('shop', 'Product Size Measure ID'),
            'group_on_page' => Yii::t('shop', 'Group On Page'),
            'product_on_page' => Yii::t('shop', 'Product On Page'),
            'template' => Yii::t('app', 'Template'),
            'template_group' => Yii::t('shop', 'Template Group'),
            'template_product' => Yii::t('shop', 'Template Product'),
            'group_image_preview_max_width' => Yii::t('shop', 'Group Image Preview Max Width'),
            'group_image_preview_max_height' => Yii::t('shop', 'Group Image Preview Max Height'),
            'group_image_max_width' => Yii::t('shop', 'Group Image Max Width'),
            'group_image_max_height' => Yii::t('shop', 'Group Image Max Height'),
            'product_image_preview_max_width' => Yii::t('shop', 'Product Image Preview Max Width'),
            'product_image_preview_max_height' => Yii::t('shop', 'Product Image Preview Max Height'),
            'product_image_max_width' => Yii::t('shop', 'Product Image Max Width'),
            'product_image_max_height' => Yii::t('shop', 'Product Image Max Height'),
            'group_sorting_type' => Yii::t('shop', 'Group Sorting Type'),
            'group_sorting_field' => Yii::t('shop', 'Group Sorting Field'),
            'group_sorting_list_field' => Yii::t('shop', 'Group Sorting List Field'),
            'product_sorting_type' => Yii::t('shop', 'Product Sorting Type'),
            'product_sorting_field' => Yii::t('shop', 'Product Sorting Field'),
            'product_sorting_list_field' => Yii::t('shop', 'Product Sorting List Field'),
            'user_id' => Yii::t('app', 'User ID'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Keyword'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image',
                'path' => '@webroot/public/uploads/shop/shop/images',
                'pathUrl' => '@web/public/uploads/shop/shop/images',
            ],
            [
                'class' => UserId::className(),
                'attribute' => 'user_id',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['shop_id' => 'id']);
    }
}
