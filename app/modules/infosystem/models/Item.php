<?php

namespace app\modules\infosystem\models;

use Yii;
use app\modules\user\models\User;
use yii\helpers\Url;

/**
 * This is the model class for table "mn_infosystem_item".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_description
 * @property string $image_content
 * @property string $file
 * @property integer $status
 * @property integer $sorting
 * @property integer $counter
 * @property integer $user_id
 * @property integer $date
 * @property integer $date_start
 * @property integer $date_end
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Item extends \app\core\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'infosystem_id', 'date'], 'required'],
            [['infosystem_id'], 'string', 'max' => 100],
            [['group_id', 'status', 'sorting', 'user_id', 'counter'], 'integer'],
            [['description', 'content', 'date', 'date_start', 'date_end'], 'string'],
            [['name', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['file', 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group'),
            'infosystem_id' => Yii::t('infosystem', 'Infosystem id'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_description' => Yii::t('app', 'Image'),
            'image_content' => Yii::t('app', 'Image'),
            'file' => Yii::t('app', 'File'),
            'status' => Yii::t('app', 'Status'),
            'sorting' => Yii::t('app', 'Sorting'),
            'counter' => Yii::t('infosystem', 'Counter'),
            'user_id' => Yii::t('app', 'User id'),
            'date' => Yii::t('app', 'Date'),
            'date_start' => Yii::t('app', 'Date start'),
            'date_end' => Yii::t('app', 'Date end'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imageDescription' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image_description',
                'path' => '@webroot/public/uploads/infosystem/images',
                'pathUrl' => '@web/public/uploads/infosystem/images',
            ],
            'imageContent' => [
                'class' => 'app\core\behaviors\file\ActionImage',
                'attribute' => 'image_content',
                'path' => '@webroot/public/uploads/infosystem/images',
                'pathUrl' => '@web/public/uploads/infosystem/images',
            ],
            'file' => [
                'class' => 'app\core\behaviors\file\ActionFile',
                'attribute' => 'file',
                'path' => '@webroot/public/uploads/infosystem/files',
                'pathUrl' => '@web/public/uploads/infosystem/files',
            ],
        ];
    }

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_DRAFT => Yii::t('app', 'Status draft'),
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
        ];
    }

    public function getItemProperties()
    {
        return $this->hasMany(ItemProperty::className(), ['item_id' => 'id'])
            ->indexBy('property_id');
    }

    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['id' => 'property_id'])
            ->via('itemProperties')
            ->indexBy('id');
    }

    public function getItemTags()
    {
        return $this->hasMany(ItemTag::className(), ['item_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('itemTags');
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
            '/infosystem/item/view',
            'id' => $this->id,
            'alias' => $this->alias,
            'infosystem_id' => $this->infosystem_id
        ], true);
    }
}
