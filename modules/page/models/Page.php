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
class Page extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
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
            'id' => Yii::t('page', 'Id'),
            'name' => Yii::t('page', 'Name'),
            'content' => Yii::t('page', 'Content'),
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
				[
					'class' => Slug::className(),
					'attribute' => 'name',
					'slugAttribute' => 'alias',
				]
			];
		}
}
