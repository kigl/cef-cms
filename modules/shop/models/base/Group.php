<?php

namespace app\modules\shop\models\base;

use Yii;
use app\core\db\ActiveRecord;

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
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Group extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['parent_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'description', 'image', 'image_small', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('shop', 'User ID'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('shop', 'Create Time'),
            'update_time' => Yii::t('shop', 'Update Time'),
        ];
    }
}
