<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_informatonsystem".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $status
 * @property integer $sort
 * @property string $seo_title
 * @property string $seo_description
 * @property integer $user_id
 * @property integer $create_time
 * @property integer $update_time
 */
class Informationsystem extends \yii\db\ActiveRecord
{
		
		const STATUS_BLOCK = 0;
		const STATUS_ACTIVE = 1;
		const STATUS_DRAFT = 2;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informatonsystem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['content'], 'string'],
            [['status', 'sort', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name', 'seo_title', 'seo_description'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            ['image', 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'description' => Yii::t('main', 'Description'),
            'content' => Yii::t('main', 'Content'),
            'image' => Yii::t('main', 'Image'),
            'status' => Yii::t('main', 'Status'),
            'sort' => Yii::t('main', 'Sort'),
            'seo_title' => Yii::t('main', 'Seo Title'),
            'seo_description' => Yii::t('main', 'Seo Description'),
            'user_id' => Yii::t('main', 'User ID'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
    
    public function behaviors()
    {
			return [
				[
					'class' => 'app\modules\main\components\behaviors\UserId',
					'attribute' => 'user_id',
				],
				[
					'class' => 'yii\behaviors\TimeStampBehavior',
					'createdAtAttribute' => 'create_time',
					'updatedAtAttribute' => 'update_time',
				],
				'imageUpload' => [
					'class' => 'app\modules\main\components\behaviors\ImageUpload',
					'attribute' => 'image',
					'resize' => [
						'width' => 200,
						'height' => 200,
					],
					'path' => Yii::$app->controller->module->getModuleImagesPath(),
					'pathUrl' => Yii::$app->controller->module->getModuleImagesPathUrl(),
				],
			];
		}
		
		public function getStatusList()
		{
			return [
				self::STATUS_BLOCK => Yii::t('main', 'informationsystem status block'),
				self::STATUS_ACTIVE => Yii::t('main', 'informationsystem status active'),
				self::STATUS_DRAFT => Yii::t('main', 'informationsystem status drafy'),
			];
		}
		
		public function getStatus($number)
		{
			$status = $this->getStatusLIst();
			
			return $status[$number];
		}
}
