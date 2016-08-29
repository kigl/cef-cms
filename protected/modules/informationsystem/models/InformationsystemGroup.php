<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_informationsystem_group".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $informationsystem_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property integer $sort
 * @property integer $user_id
 * @property integer $create_time
 * @property integer $update_time
 */
class InformationsystemGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informationsystem_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'informationsystem_id', 'status', 'sort', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['name'], 'required'],
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
            'parent_id' => Yii::t('main', 'Parent ID'),
            'informationsystem_id' => Yii::t('main', 'Informationsystem ID'),
            'name' => Yii::t('main', 'Name'),
            'description' => Yii::t('main', 'Description'),
            'image' => Yii::t('main', 'Image'),
            'status' => Yii::t('main', 'Status'),
            'sort' => Yii::t('main', 'Sort'),
            'user_id' => Yii::t('main', 'User ID'),
            'create_time' => Yii::t('main', 'Create Time'),
            'update_time' => Yii::t('main', 'Update Time'),
        ];
    }
}
