<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagRelations;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\components\TagBehavior;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_informationsystem_item".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $item_type
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
class InformationsystemItem extends \yii\db\ActiveRecord
{
		const TYPE_GROUP = 0;
		const TYPE_ITEM = 1;
		
		const STATUS_BLOCK = 0;
		const STATUS_ACTIVE = 1;
		const STATUS_DRAFT = 2;
		
		protected $_tags;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informationsystem_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'item_type', 'status', 'sort', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name', 'item_type',], 'required'],
            [['content'], 'string'],
            [['informationsystem_id'], 'string', 'max' => 50],
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
            'id' => Yii::t('informationsystem', 'ID'),
            'parent_id' => Yii::t('informationsystem', 'Parent ID'),
            'item_type' => Yii::t('informationsystem', 'Item Type'),
            'informationsystem_id' => Yii::t('informationsystem', 'Informationsystem ID'),
            'name' => Yii::t('informationsystem', 'Name'),
            'tag_list' => Yii::t('informationsystem', 'Tags'),
            'description' => Yii::t('informationsystem', 'Description'),
            'content' => Yii::t('informationsystem', 'Content'),
            'image' => Yii::t('informationsystem', 'Image'),
            'status' => Yii::t('informationsystem', 'Status'),
            'sort' => Yii::t('informationsystem', 'Sort'),
            'user_id' => Yii::t('informationsystem', 'User id'),
            'date' => Yii::t('informationsystem', 'Date'),
            'date_start' => Yii::t('informationsystem', 'Date Start'),
            'date_end' => Yii::t('informationsystem', 'Date End'),
            'alias' => Yii::t('informationsystem', 'Alias'),
            'meta_title' => Yii::t('informationsystem', 'Meta title'),
            'meta_description' => Yii::t('informationsystem', 'Meta Description'),
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
					'class' => 'app\modules\main\components\behaviors\ImageUpload',
					'attribute' => 'image',
					'deleteKey' => 'deleteImage',
					'path' => Yii::$app->controller->module->getImagesPath(),
					'pathUrl' => Yii::$app->controller->module->getImagesPathUrl(),
					'thumbnail' => [
						'width' => 350,
						'height' => 233,
					],
				],
				'videoUpload' => [
					'class' => 'app\modules\main\components\behaviors\FileUpload',
					'attribute' => 'video',
					'deleteKey' => 'deleteVideo',
					'path' => Yii::$app->controller->module->getPublicPath() . DS . 'video',
					'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/video',
				],
				'fileUpload' => [
					'class' => 'app\modules\main\components\behaviors\FileUpload',
					'attribute' => 'file',
					'deleteKey' => 'deleteFile',
					'path' => Yii::$app->controller->module->getPublicPath() . DS . 'files',
					'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/files',
				],
				[
					'class' => 'yii\behaviors\TimeStampBehavior',
					'createdAtAttribute' => 'create_time',
					'updatedAtAttribute' => 'update_time',
				],
				[
					'class' => TagBehavior::className(),
				],
			];
		}
		
		public function beforeSave($insert)
		{
			if (parent::beforeSave($insert)) {
				if ($this->isNewRecord) $this->user_id = Yii::$app->user->getId();
				
				return true;
			}
		}
		
		public function getStatusList()
		{
			return [
				self::STATUS_BLOCK => Yii::t('main', 'Status block'),
				self::STATUS_ACTIVE => Yii::t('main', 'Status active'),
				self::STATUS_DRAFT => Yii::t('main', 'Status draft'),
			];
		}
		
		public function getStatus($number)
		{
			return ArrayHelper::getValue($this->getStatusList(), $number);
		}
    
    public function getTypeList()
    {
			return [
				self::TYPE_GROUP => Yii::t('main', 'Informationsystem item type group'),
				self::TYPE_ITEM => Yii::t('main', 'Informationsystem item type item'),
			];
		}
		
		public function getTypeIcon($type_id) 
		{
			switch ($type_id) {
				case self::TYPE_GROUP :
					return '<i class="glyphicon glyphicon-folder-open"></i>';
				case self::TYPE_ITEM : 
					return '<i class="glyphicon glyphicon-list-alt"></i>';
			}
		}
		
		/**
		*	Строит путь с вложениями для виджета Breadcrumbs
		* @param integer $id
		* 
		* @return array | false
		*/
		public static function buildBreadcrumbs($id = null, $informationsystem_id)
		{
			$modelSystem = System::getSystem($informationsystem_id);

			$result[] = [
				'label' => $modelSystem->name,
				'url' => ['backend/manager/item', 'informationsystem_id' => $informationsystem_id],
			];
			
			if ($id !== null and $breadcrumbs = self::recursive($id)) {
				$c = count($breadcrumbs) - 1;
				$breadcrumbs[$c]['span'] = 1;
				
				foreach ($breadcrumbs as $model)
				{
					if (!isset($model['span'])) {
						$result[] = [
								'label' => $model['name'],
								'url' => [
									'backend/manager/item',
									'group_id' => $model['id'],
									'informationsystem_id' => $model['informationsystem_id']
								]
						];		
					} else {
						$result[] = ['label' => $model['name']];				
					}
				}
			}
			
			return (!empty($result))? $result : null;
		}
		
		/**
		* Рекурсивная функция для построение массива
		* @param integer $id
		* 
		* @return array | false
		*/
		protected static function recursive($id)
		{
			$model = self::find()
					->select(['id', 'parent_id', 'name', 'informationsystem_id'])
					->where('id = :id', [':id' => $id])
					->asArray()
					->one();
			
			if ($model) {
				$result =	self::recursive($model['parent_id']);
				
				$result[] = [
						'id' => $model['id'],
						'parent_id' => $model['parent_id'],
						'name' => $model['name'],
						'informationsystem_id' => $model['informationsystem_id'],
						];
			}
			
			return (!empty($result))? $result : false;
		}		
}
