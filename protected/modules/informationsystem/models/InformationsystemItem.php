<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_informationsystem_item".
 *
 * @property integer $id
 * @property integer $informationsystem_id
 * @property integer $informationsystem_group_id
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
 * @property integer $create_time
 * @property integer $update_time
 */
class InformatonsystemItem extends \yii\db\ActiveRecord
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
            [['informationsystem_id', 'informationsystem_group_id', 'status', 'sort', 'user_id', 'date', 'date_start', 'date_end', 'create_time', 'update_time'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
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
            'informationsystem_id' => Yii::t('main', 'Informationsystem ID'),
            'informationsystem_group_id' => Yii::t('main', 'Informationsystem Group ID'),
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
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
}
