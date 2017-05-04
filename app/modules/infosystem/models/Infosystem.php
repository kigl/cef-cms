<?php

namespace app\modules\infosystem\models;


use Yii;

/**
 * This is the model class for table "mn_infosystem".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $indexing
 * @property integer $group_on_page
 * @property integer $item_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_item
 * @property string $template_tag
 * @property integer $sorting_type_gruop
 * @property integer $sorting_field_gruop
 * @property string $sorting_list_field_group
 * @property integer $sorting_type_item
 * @property integer $sorting_field_item
 * @property string $sorting_list_field_item
 * @property string $meta_title
 * @property string $meta_description
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
            [['name', 'id'], 'required'],
            [['id', 'sorting_field_group', 'sorting_field_item'], 'string', 'max' => 100],
            ['id', 'unique'],
            [['indexing', 'group_on_page', 'item_on_page', 'sorting_type_group', 'sorting_type_item'], 'integer'],
            [['content'], 'string'],
            [
                [
                    'name',
                    'template',
                    'template_group',
                    'template_item',
                    'template_tag',
                    'sorting_list_field_group',
                    'sorting_list_field_item'
                ],
                'string',
                'max' => 255
            ],
            [['description'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'indexing' => Yii::t('app', 'Indexing'),
            'group_on_page' => Yii::t('app', 'Group on page'),
            'item_on_page' => Yii::t('app', 'Item on page'),
            'template' => Yii::t('infosystem', 'Template'),
            'template_group' => Yii::t('infosystem', 'Template group'),
            'template_item' => Yii::t('infosystem', 'Template item'),
            'template_tag' => Yii::t('infosystem', 'Template tag'),
            'sorting_type_group' => Yii::t('infosystem', 'Sorting type group'),
            'sorting_field_group' => Yii::t('infosystem', 'Sorting field group'),
            'sorting_list_field_group' => Yii::t('infosystem', 'Sorting list field group'),
            'sorting_type_item' => Yii::t('infosystem', 'Sorting type item'),
            'sorting_field_item' => Yii::t('infosystem', 'Sorting field item'),
            'sorting_list_field_item' => Yii::t('infosystem', 'Sorting list field item'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
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
