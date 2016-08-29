<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_informationsystem_item".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $informationsystem_id
 * @property integer $item_type
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
 * @property string $seo_title
 * @property string $seo_description
 * @property integer $create_time
 * @property integer $update_time
 */
class InformationsystemItem extends \yii\db\ActiveRecord
{
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
            [['parent_id', 'informationsystem_id', 'item_type', 'status', 'sort', 'user_id', 'date', 'date_start', 'date_end', 'create_time', 'update_time'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name', 'image', 'seo_title'], 'string', 'max' => 255],
            [['description', 'seo_description'], 'string', 'max' => 300],
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
            'informationsystem_id' => Yii::t('main', 'Informationsystem ID'),
            'item_type' => Yii::t('main', 'Item Type'),
            'name' => Yii::t('main', 'Name'),
            'description' => Yii::t('main', 'Description'),
            'content' => Yii::t('main', 'Content'),
            'image' => Yii::t('main', 'Image'),
            'status' => Yii::t('main', 'Status'),
            'sort' => Yii::t('main', 'Sort'),
            'user_id' => Yii::t('main', 'User ID'),
            'date' => Yii::t('main', 'Date'),
            'date_start' => Yii::t('main', 'Date Start'),
            'date_end' => Yii::t('main', 'Date End'),
            'seo_title' => Yii::t('main', 'Seo Title'),
            'seo_description' => Yii::t('main', 'Seo Description'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
}
