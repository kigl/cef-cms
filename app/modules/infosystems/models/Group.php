<?php

namespace app\modules\infosystems\models;


use Yii;
use yii\helpers\Url;

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
 * @property string $image
 * @property integer $status
 * @property integer $user_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property integer $create_time
 * @property integer $update_time
 */
class Group extends \app\core\db\ActiveRecord
{

    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;

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
            [['infosystem_id', 'parent_id', 'user_id', 'sorting'], 'integer'],
            [['content'], 'string'],
            [['name', 'alias', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'infosystem_id' => Yii::t('infosystems', 'Infosystem ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image'),
            'image' => Yii::t('app', 'Image'),
            'sorting' => Yii::t('app', 'Sorting'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta keyword'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image_preview',
                'path' => '@webroot/public/uploads/infosystems/group/images',
                'pathUrl' => '@web/public/uploads/infosystems/group/images',
            ],
            'image' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image',
                'path' => '@webroot/public/uploads/infosystems/group/images',
                'pathUrl' => '@web/public/uploads/infosystems/group/images',
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

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
        ];
    }

    public function getModelItems()
    {
        return self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->joinWith(['infosystem as info'], true, 'LEFT JOIN')
            ->where(['info.indexing' => Infosystem::INDEXING_YES])
            ->all();
    }

    public function getModelItemUrl()
    {
        return Url::to([
            '/infosystems/group/view',
            'id' => $this->id,
            'alias' => $this->alias,
            'infosystem_id' => $this->infosystem_id
        ], true);
    }
}
