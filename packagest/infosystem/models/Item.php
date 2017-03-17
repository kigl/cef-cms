<?php

namespace kigl\cef\module\infosystem\models;

use Yii;
use kigl\cef\module\tag\components\TagBehavior;
use kigl\cef\module\user\models\User;

/**
 * This is the model class for table "mn_infosystem_item".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_preview
 * @property string $image_content
 * @property string $file
 * @property integer $status
 * @property integer $sorting
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
class Item extends \kigl\cef\core\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;

    protected $_tags;

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
            [['name', 'infosystem_id'], 'required'],
            [['infosystem_id'], 'string', 'max' => 100],
            [['group_id', 'status', 'sorting', 'user_id'], 'integer'],
            [['date', 'date_start', 'date_end'], 'string'],
            [['content'], 'string'],
            [['name', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            [['image_preview', 'image_content'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
            //['video', 'file', 'extensions' => ['mp4']],
            //['file', 'file'], // video
            ['editorTag', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('infosystem', 'Group id'),
            'infosystem_id' => Yii::t('infosystem', 'Infosystem id'),
            'name' => Yii::t('app', 'Name'),
            'tag_list' => Yii::t('infosystem', 'Tags'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image preview'),
            'image_content' => Yii::t('app', 'Image content'),
            //'video' => Yii::t('app', 'Video'),
            //'file' => Yii::t('app', 'File'),
            'editorTag' => Yii::t('infosystem', 'Editor tag'),
            'status' => Yii::t('app', 'Status'),
            'sorting' => Yii::t('app', 'Sorting'),
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

    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function behaviors()
    {
        return [
            'UploadImagePreview' => [
                'class' => 'app\core\behaviors\file\UploadImage',
                'attribute' => 'image_preview',
                //'deleteKey' => 'deleteImagePreview',
                'path' => Yii::$app->getModule('infosystem')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('infosystem')->getPublicPathUrl() . '/images',
            ],
            'UploadImageContent' => [
                'class' => 'app\core\behaviors\file\UploadImage',
                'attribute' => 'image_content',
                //'deleteKey' => 'deleteImageContent',
                'path' => Yii::$app->getModule('infosystem')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('infosystem')->getPublicPathUrl() . '/images',
            ],
            /*'videoUpload' => [
                'class' => 'app\core\behaviors\file\UploadFile',
                'attribute' => 'video',
                'deleteKey' => 'deleteVideo',
                'path' => Yii::$app->controller->module->getPublicPath() . '/video',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/video',
            ],
            'fileUpload' => [
                'class' => 'app\core\behaviors\file\UploadFile',
                'attribute' => 'file',
                'deleteKey' => 'deleteFile',
                'path' => Yii::$app->controller->module->getPublicPath() . '/files',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/files',
            ],*/
            [
                'class' => TagBehavior::className(),
                'relativeModelClass' => ItemTag::class,
            ],
            'convertDate' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date',
            ],
            'convertDateStart' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_start',
            ],
            'convertDateEnd' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_end',
            ],
            [
              'class' => 'app\core\behaviors\FillData',
                'attribute' => 'create_time',
                'setAttribute' => 'date',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
            [
                'class' => 'app\core\behaviors\UserId',
                'attribute' => 'user_id',
            ],
            [
                'class' => 'app\core\behaviors\GenerateAlias',
                'text' => 'name',
                'alias' => 'alias',
            ],
        ];
    }

    public function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_DRAFT => Yii::t('app', 'Status draft'),
        ];
    }

    public function getProperties()
    {
        return $this->hasMany(ItemProperty::className(), ['item_id' => 'id']);
    }
}
