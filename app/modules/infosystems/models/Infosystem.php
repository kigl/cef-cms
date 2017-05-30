<?php

namespace app\modules\infosystems\models;


use Yii;
use app\modules\infosystems\Module;

/**
 * This is the model class for table "mn_infosystems".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $content
 * @property string $site_id
 * @property integer $indexing
 * @property integer $group_on_page
 * @property integer $item_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_item
 * @property string $template_tag
 * @property string $max_width_images_preview_group
 * @property string $max_height_image_preview_group
 * @property string $max_width_images_group
 * @property string $max_height_image_group
 * @property string $max_width_images_preview_item
 * @property string $max_height_image_preview_item
 * @property string $max_width_images_item
 * @property string $max_height_image_item
 * @property integer $sorting_type_gruop
 * @property integer $sorting_field_gruop
 * @property string $sorting_list_field_group
 * @property integer $sorting_type_item
 * @property integer $sorting_field_item
 * @property string $sorting_list_field_item
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property integer $create_time
 * @property integer $update_time
 */
class Infosystem extends \app\core\db\ActiveRecord
{
    const INDEXING_NO = 0;
    const INDEXING_YES = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [
                [
                    'indexing',
                    'group_on_page',
                    'item_on_page',
                    'sorting_type_group',
                    'sorting_type_item',
                    'max_width_image_preview_group',
                    'max_height_image_preview_group',
                    'max_width_image_group',
                    'max_height_image_group',
                    'max_width_image_preview_item',
                    'max_height_image_preview_item',
                    'max_width_image_item',
                    'max_height_image_item',
                ],
                'integer'
            ],
            [['content'], 'string'],
            ['image', 'image'],
            [
                [
                    'code',
                    'name',
                    'template',
                    'template_group',
                    'template_item',
                    'template_tag',
                    'sorting_field_group',
                    'sorting_list_field_group',
                    'sorting_field_item',
                    'sorting_list_field_item',
                    'meta_title',
                    'meta_description',
                    'meta_keyword',
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'content' => Yii::t('app', 'Content'),
            'indexing' => Yii::t('app', 'Indexing'),
            'group_on_page' => Yii::t('app', 'Group on page'),
            'item_on_page' => Yii::t('app', 'Item on page'),
            'template' => Yii::t('infosystems', 'Template'),
            'template_group' => Yii::t('infosystems', 'Template group'),
            'template_item' => Yii::t('infosystems', 'Template item'),
            'template_tag' => Yii::t('infosystems', 'Template tag'),
            'max_width_image_preview_group' => Yii::t('infosystems', 'Max width image preview group'),
            'max_height_image_preview_group' => Yii::t('infosystems', 'Max height image preview group'),
            'max_width_image_group' => Yii::t('infosystems', 'Max width image group'),
            'max_height_image_group' => Yii::t('infosystems', 'Max height image group'),
            'max_width_image_preview_item' => Yii::t('infosystems', 'Max width image preview item'),
            'max_height_image_preview_item' => Yii::t('infosystems', 'Max height image preview item'),
            'max_width_image_item' => Yii::t('infosystems', 'Max width image item'),
            'max_height_image_item'=> Yii::t('infosystems', 'Max height image item'),
            'sorting_type_group' => Yii::t('infosystems', 'Sorting type group'),
            'sorting_field_group' => Yii::t('infosystems', 'Sorting field group'),
            'sorting_list_field_group' => Yii::t('infosystems', 'Sorting list field group'),
            'sorting_type_item' => Yii::t('infosystems', 'Sorting type item'),
            'sorting_field_item' => Yii::t('infosystems', 'Sorting field item'),
            'sorting_list_field_item' => Yii::t('infosystems', 'Sorting list field item'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'meta_keyword' => Yii::t('app', 'Meta keywords'),
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
                'path' => '@webroot/public/uploads/infosystems/infosystem/images',
                'pathUrl' => '@web/public/uploads/infosystems/infosystem/images',
            ],
        ];
    }

    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['infosystem_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['infosystem_id' => 'id']);
    }

    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['infosystem_id' => 'id']);
    }

    public function getSortingListFieldGroup()
    {
        return array_values((array)json_decode($this->sorting_list_field_group));
    }

    public function getSortingListFieldItem()
    {
        return array_values((array)json_decode($this->sorting_list_field_item));
    }
}
