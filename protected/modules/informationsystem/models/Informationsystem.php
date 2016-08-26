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
            [['name', 'image', 'seo_title', 'seo_description'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
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
			];
		}
}
