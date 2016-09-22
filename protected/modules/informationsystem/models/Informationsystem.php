<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_informationsystem".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $status
 * @property integer $sort
 * @property string $meta_title
 * @property string $meta_description
 * @property string $template
 * @property integer $user_id
 * @property integer $items_on_page
 * @property integer $create_time
 * @property integer $update_time
 */
class Informationsystem extends \yii\db\ActiveRecord
{
		const STATUS_BLOCK = 0;
		const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informationsystem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description'], 'required'],
            [['content'], 'string'],
            [['status', 'sort', 'user_id', 'items_per_page', 'create_time', 'update_time'], 'integer'],
            [['id', 'template'], 'string', 'max' => 50],
            [['name', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            ['image', 'file'],
            ['items_per_page', 'default', 'value' => 10],
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
            'meta_title' => Yii::t('main', 'Seo Title'),
            'meta_description' => Yii::t('main', 'Seo Description'),
            'template' => Yii::t('main', 'Template'),
            'user_id' => Yii::t('main', 'User ID'),
            'items_on_page' => Yii::t('main', 'Items on page'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
    
    public function behaviors()
    {
			return [
				[
					'class' => 'yii\behaviors\TimestampBehavior',
					'createdAtAttribute' => 'create_time',
					'updatedAtAttribute' => 'update_time',
				],
				[
					'class' => 'app\modules\main\components\behaviors\ImageUpload',
					'attribute' => 'image',
					'path' => Yii::$app->controller->module->getImagesPath(),
					'pathUrl' => Yii::$app->controller->module->getImagesPathUrl(),
				]
			];
		}
    
    public function getStatusList()
    {
			return [
				self::STATUS_BLOCK => Yii::t('main', 'status block'),
				self::STATUS_ACTIVE => Yii::t('main', 'status active'),
			];
		}
		
		public function getStatus($id)
		{
			$status = $this->getStatusList();
			return $status[$id];
		}
		
		public static function getSystem($id, $type = 'object')
		{
			$model = self::find()->where('id = :id', [':id' => $id]);
			
			if ($type === 'array') {
				$model->asArray();
			}
			
			$result = $model->one();
			
			if ($result) {
				return $result;
			}
			return false;
		}
}
