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
 * @property integer $item_on_page
 * @property string $template_group
 * @property string $template_item
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
            [['id'], 'string', 'max' => 100],
            ['item_on_page', 'integer'],
            [['content'], 'string'],
            [['name', 'template_group', 'template_item'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            [['template_group', 'template_item'], 'default', 'value' => 'view'],
            ['item_on_page', 'default', 'value' => '30'],
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
            'item_on_page' => Yii::t('app', 'Item on page'),
            'template_group' => Yii::t('infosystem', 'Template group'),
            'template_item' => Yii::t('infosystem', 'Template item'),
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
}
