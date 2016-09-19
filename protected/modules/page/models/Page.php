<?php

namespace app\modules\page\models;

use Yii;
use	yii\behaviors\SluggableBehavior as Slug;

/**
 * This is the model class for table "mn_page".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		[['name'], 'required'],
            [['content', 'alias'], 'string'],
            [['create_time', 'update_time'], 'integer'],
            [['name', 'meta_title', 'meta_description'], 'string', 'max' => 255],
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
            'content' => Yii::t('main', 'Content'),
            'alias' => Yii::t('main', 'Alias'),
            'meta_title' => Yii::t('main', 'Meta Title'),
            'meta_description' => Yii::t('main', 'Meta Description'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
    
    public function behaviors()
    {
			return [
				[
					'class' => Slug::className(),
					'attribute' => 'name',
					'slugAttribute' => 'alias',
				]
			];
		}
}
