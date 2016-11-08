<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\components\TagBehavior;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_informationsystem_item".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $informationsystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $file
 * @property integer $status
 * @property integer $sort
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
class Item extends \app\core\db\ActiveRecord  implements \app\modules\user\components\AuthorInterface
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
        return '{{%informationsystem_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'informationsystem_id', 'status', 'sort', 'user_id'], 'integer'],
            [['date', 'date_start', 'date_end'], 'date'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            ['image', 'file', 'extensions' => ['jpg', 'png', 'gif']],
            ['video', 'file', 'extensions' => ['mp4']],
            ['file', 'file'], // video

            ['editorTag', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('informationsystem', 'Id'),
            'group_id' => Yii::t('informationsystem', 'Group id'),
            'informationsystem_id' => Yii::t('informationsystem', 'Informationsystem id'),
            'name' => Yii::t('informationsystem', 'Name'),
            'tag_list' => Yii::t('informationsystem', 'Tags'),
            'description' => Yii::t('informationsystem', 'Description'),
            'content' => Yii::t('informationsystem', 'Content'),
            'image' => Yii::t('informationsystem', 'Image'),
            'video' => Yii::t('informationsystem', 'Video'),
            'file' => Yii::t('informationsystem', 'File'),
            'editorTag' => Yii::t('informationsystem', 'Editor tag'),
            'status' => Yii::t('informationsystem', 'Status'),
            'sort' => Yii::t('informationsystem', 'Sort'),
            'user_id' => Yii::t('informationsystem', 'User id'),
            'date' => Yii::t('informationsystem', 'Date'),
            'date_start' => Yii::t('informationsystem', 'Date start'),
            'date_end' => Yii::t('informationsystem', 'Date end'),
            'alias' => Yii::t('informationsystem', 'Alias'),
            'meta_title' => Yii::t('informationsystem', 'Meta title'),
            'meta_description' => Yii::t('informationsystem', 'Meta description'),
            'create_time' => Yii::t('informationsystem', 'Create time'),
            'update_time' => Yii::t('informationsystem', 'Update time'),
        ];
    }

    public function getSystem()
    {
        return $this->hasOne(System::className(), ['id' => 'informationsystem_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function behaviors()
    {
        return [
            'imageUpload' => [
                'class' => 'app\core\behaviors\file\ImageUpload',
                'attribute' => 'image',
                'deleteKey' => 'deleteImage',
                'path' => Yii::$app->controller->module->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/images',
                'thumbnail' => [
                    'width' => 350,
                    'height' => 233,
                ],
            ],
            'videoUpload' => [
                'class' => 'app\core\behaviors\file\FileUpload',
                'attribute' => 'video',
                'deleteKey' => 'deleteVideo',
                'path' => Yii::$app->controller->module->getPublicPath() . '/video',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/video',
            ],
            'fileUpload' => [
                'class' => 'app\core\behaviors\file\FileUpload',
                'attribute' => 'file',
                'deleteKey' => 'deleteFile',
                'path' => Yii::$app->controller->module->getPublicPath() . '/files',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/files',
            ],
            [
                'class' => 'yii\behaviors\TimeStampBehavior',
                'value' => new Expression('NOW()'),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            [
                'class' => TagBehavior::className(),
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
                'setAttribute' => 'date',
                'getAttribute' => 'create_time',
            ],
            [
                'class' => 'app\core\behaviors\UserId',
                'attribute' => 'user_id',
            ],
        ];
    }

    public function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('informationsystem', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('informationsystem', 'Status active'),
            self::STATUS_DRAFT => Yii::t('informationsystem', 'Status draft'),
        ];
    }

    public function getStatus($number)
    {
        return ArrayHelper::getValue($this->getStatusList(), $number);
    }
}
