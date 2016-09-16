<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagRelations;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\components\TagBehavior;

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
            [['name', 'item_type'], 'required'],
            [['content'], 'string'],
            [['informationsystem_id', 'date', 'date_start', 'date_end'], 'string', 'max' => 50],
            [['name', 'alias', 'meta_title'], 'string', 'max' => 255],
            [['description', 'meta_description'], 'string', 'max' => 300],
            ['image', 'file'],
            
            ['editorTag', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'parent_id' => Yii::t('main', 'Parent ID'),
            'item_type' => Yii::t('main', 'Item Type'),
            'informationsystem_id' => Yii::t('main', 'Informationsystem ID'),
            'name' => Yii::t('main', 'Name'),
            'tag_list' => Yii::t('main', 'Tags'),
            'description' => Yii::t('main', 'Description'),
            'content' => Yii::t('main', 'Content'),
            'image' => Yii::t('main', 'Image'),
            'status' => Yii::t('main', 'Status'),
            'sort' => Yii::t('main', 'Sort'),
            'user_id' => Yii::t('main', 'User ID'),
            'date' => Yii::t('main', 'Date'),
            'date_start' => Yii::t('main', 'Date Start'),
            'date_end' => Yii::t('main', 'Date End'),
            'alias' => Yii::t('main', 'Alias'),
            'meta_title' => Yii::t('main', 'Meta title'),
            'meta_description' => Yii::t('main', 'Meta Description'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
    
    public function getSystem()
    {
			return $this->hasOne(System::className(), ['id' => 'informationsystem_id']);
		}
    
    public function behaviors()
    {
			return [
				[
					'class' => 'app\modules\main\components\behaviors\ImageUpload',
					'attribute' => 'image',
					'path' => Yii::$app->controller->module->getImagesPath(),
					'pathUrl' => Yii::$app->controller->module->getImagesPathUrl(),
				],
				[
					'class' => 'yii\behaviors\TimeStampBehavior',
					'createdAtAttribute' => 'create_time',
					'updatedAtAttribute' => 'update_time',
				],
				[
					'class' => 'app\modules\main\components\behaviors\UrlFillTranslitText',
					'text' => 'name',
					'url' => 'alias',
				],
				[
					'class' => TagBehavior::className(),
				],
			];
		}
		
		public function beforeSave($insert)
		{	
			$this->date = $this->getTimeStamp($this->date);
			$this->date_start = $this->getTimeStamp($this->date_start);
			$this->date_end = $this->getTimeStamp($this->date_end);
			
			return parent::beforeSave($insert);
		}
		
		
		private function getTimeStamp($date)
		{
			if ($date != '') {
				return Yii::$app->formatter->asTimeStamp($date);
			}
			return null;
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
		public static function buildBreadcrumbs($id, $informationsystem_id)
		{
			$modelSystem = System::getSystem($informationsystem_id);

			$result[] = [
				'label' => $modelSystem->name,
				'url' => ['backend/manager/item', 'informationsystem_id' => $informationsystem_id],
			];
			
			if ($breadcrumbs = self::recursive($id)) {
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
