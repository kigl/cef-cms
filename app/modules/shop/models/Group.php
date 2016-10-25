<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_group".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $image_small
 * @property integer $status
 * @property integer $sort
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Group extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_shop_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'sort', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'description', 'image', 'image_small'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'parent_id' => Yii::t('shop', 'Parent id'),
            'name' => Yii::t('shop', 'Name'),
            'description' => Yii::t('shop', 'Description'),
            'content' => Yii::t('shop', 'Content'),
            'image' => Yii::t('shop', 'Image'),
            'image_small' => Yii::t('shop', 'Image Small'),
            'status' => Yii::t('shop', 'Status'),
            'sort' => Yii::t('shop', 'Sort'),
            'user_id' => Yii::t('shop', 'User ID'),
            'create_time' => Yii::t('shop', 'Create Time'),
            'update_time' => Yii::t('shop', 'Update Time'),
        ];
    }
}
