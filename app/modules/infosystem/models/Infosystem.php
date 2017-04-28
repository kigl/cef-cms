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
 * @property integer $group_on_page
 * @property integer $item_on_page
 * @property string $template
 * @property string $template_group
 * @property string $template_item
 * @property integer $sorting_type_gruop
 * @property integer $sorting_attribute_gruop
 * @property string $sorting_list_attribute_group
 * @property integer $sorting_type_item
 * @property integer $sorting_attribute_item
 * @property string $sorting_list_attribute_item
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Infosystem extends \app\core\db\ActiveRecord
{
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
            [['id', 'sorting_attribute_group', 'sorting_attribute_item'], 'string', 'max' => 100],
            ['id', 'unique'],
            [['group_on_page', 'item_on_page', 'sorting_type_group', 'sorting_type_item'], 'integer'],
            [['content'], 'string'],
            [
                [
                    'name',
                    'template',
                    'template_group',
                    'template_item',
                    'sorting_list_attribute_group',
                    'sorting_list_attribute_item'
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
            'group_on_page' => Yii::t('app', 'Group on page'),
            'item_on_page' => Yii::t('app', 'Item on page'),
            'template' => Yii::t('infosystem', 'Template'),
            'template_group' => Yii::t('infosystem', 'Template group'),
            'template_item' => Yii::t('infosystem', 'Template item'),
            'sorting_type_group' => Yii::t('infosystem', 'Sorting type group'),
            'sorting_attribute_group' => Yii::t('infosystem', 'Sorting attribute group'),
            'sorting_list_attribute_group' => Yii::t('infosystem', 'Sorting list attribute group'),
            'sorting_type_item' => Yii::t('infosystem', 'Sorting type item'),
            'sorting_attribute_item' => Yii::t('infosystem', 'Sorting attribute item'),
            'sorting_list_attribute_item' => Yii::t('infosystem', 'Sorting list attribute item'),
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

    public function getSortingListAttributeGroup()
    {
        return array_values((array)json_decode($this->sorting_list_attribute_group));
    }

    public function getSortingListAttributeItem()
    {
        return array_values((array)json_decode($this->sorting_list_attribute_item));
    }
}
