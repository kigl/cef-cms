<?php

namespace app\modules\infosystem\models;


use Yii;

/**
 * This is the model class for table "mn_infosystem_group".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_1
 * @property string $image_2
 * @property integer $user_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Group extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'infosystem_id'], 'required'],
            [['infosystem_id'], 'string', 'max' => 100],
            [['parent_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['name', 'alias', 'meta_title'], 'string', 'max' => 255],
            [['description', 'meta_description'], 'string', 'max' => 300],
            [['image_1', 'image_2'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'infosystem_id' => Yii::t('infosystem', 'Infosystem ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_1' => Yii::t('app', 'Image'),
            'image_2' => Yii::t('app', 'Image'),
            'user_id' => Yii::t('app', 'User ID'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image_1',
                'path' => '@webroot/public/upload/infosystem',
                'pathUrl' => '@web/public/upload/infosystem',
            ],
            'imageContent' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image_2',
                'path' => '@webroot/public/upload/infosystem',
                'pathUrl' => '@web/public/upload/infosystem',
            ],
        ];
    }

    public function getSubGroups()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['group_id' => 'id']);
    }

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }
}
