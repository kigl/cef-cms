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
 * @property string $image_preview
 * @property string $image_content
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
            [['image_preview', 'image_content'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
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
            'image_preview' => Yii::t('app', 'Image preview'),
            'image_content' => Yii::t('app', 'Image content'),
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
            'UploadImagePreview' => [
                'class' => 'app\core\behaviors\file\UploadImage',
                'attribute' => 'image_preview',
                'deleteKey' => 'deleteImagePreview',
                'path' => Yii::$app->getModule('infosystem')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('infosystem')->getPublicPathUrl() . '/images',
            ],
            'UploadImageContent' => [
                'class' => 'app\core\behaviors\file\UploadImage',
                'attribute' => 'image_content',
                'deleteKey' => 'deleteImageContent',
                'path' => Yii::$app->getModule('infosystem')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('infosystem')->getPublicPathUrl() . '/images',
            ],
            [
                'class' => 'app\core\behaviors\GenerateAlias',
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
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

    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
