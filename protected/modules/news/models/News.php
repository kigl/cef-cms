<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "mn_news".
 *
 * @property integer $id
 * @property integer $category
 * @property string $short_description
 * @property string $content
 * @property string $image_preview
 * @property integer $user_id
 * @property integer $date
 * @property integer $create_time
 * @property integer $update_time
 * @property string $meta_title
 * @property string $meta_description
 */
class News extends \app\modules\main\components\ActiveRecord
{
		const STATUS_ACTIVE = 1;
		const STATUS_BLOCK = 0;
		const STATUS_DRAFT = 2;
	
		public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title' ,'short_description', 'date'], 'required'],
            [['category', 'user_id', 'create_time', 'update_time', 'status'], 'integer'],
            [['short_description', 'content'], 'string'],
            [['meta_title', 'meta_description'], 'string', 'max' => 255],
            [['image_preview'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'category' => Yii::t('main', 'Category'),
            'title' => Yii::t('main', 'Title'),
            'short_description' => Yii::t('main', 'Short Description'),
            'content' => Yii::t('main', 'Content'),
            'image_previewimage_preview' => Yii::t('main', 'Image Preview'),
            'user_id' => Yii::t('main', 'User ID'),
            'date' => Yii::t('main', 'Date'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
            'meta_title' => Yii::t('main', 'Meta Ttile'),
            'meta_description' => Yii::t('main', 'Meta Description'),
        ];
    }
    
    public function behaviors()
    {
			return [
				'ImageUpload' => [
					'class' => 'app\modules\main\components\behaviors\ImageUpload',
					'attribute' => 'image_preview',
					'resize' => [
						'width' => 200,
						'height' => 200,
					],
					'path' => Yii::$app->controller->module->getModuleImagesPath(),
					'pathUrl' => Yii::$app->controller->module->getModuleImagesPathUrl(),
				],
				[
				'class' => 'yii\behaviors\TimestampBehavior',
				'createdAtAttribute' => 'create_time',
				'updatedAtAttribute' => 'update_time',
				],
			];
		}
    
    public static function getStatusList()
    {
			return [
				self::STATUS_BLOCK => Yii::t('main', 'news status block'),
				self::STATUS_ACTIVE => Yii::t('main', 'news status active'),
				self::STATUS_DRAFT => Yii::t('main', 'news status draft'),
			];
		}
		
		public static function getStatus($status)
		{
			$list = self::getStatusList();
			
			return $list[$status];
		}
		
		public function beforeSave($insert)
		{
			$this->date = Yii::$app->formatter->asTimeStamp($this->date);
			
			return parent::beforeSave($insert);
		}
}
