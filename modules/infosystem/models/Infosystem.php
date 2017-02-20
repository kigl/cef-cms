<?php

namespace app\modules\infosystem\models;

use Yii;

/**
 * This is the model class for table "mn_infosystem".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $element_on_page
 * @property string $template_group
 * @property string $template_element
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
            ['element_on_page', 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name', 'template_group', 'template_element'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            [['template_group', 'template_element'], 'default', 'value' => 'view'],
            ['element_on_page', 'default', 'value' => '30'],
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
            'element_on_page' => Yii::t('app', 'Element on page'),
            'template_group' => Yii::t('infosystem', 'Template group'),
            'template_element' => Yii::t('infosystem', 'Template element'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function getItemGroups()
    {
        return $this->hasMany(Group::className(), ['infosystem_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Element::className(), ['infosystem_id' => 'id']);
    }

    public static function getSystem($id, $type = 'object')
    {
        $model = self::find()->where('id = :id', [':id' => $id]);

        if ($type === 'array') {
            $model->asArray();
        }

        $result = $model->one();

        if ($result) {
            return $result;
        }
        return false;
    }
}
