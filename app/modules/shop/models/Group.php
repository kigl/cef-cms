<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\core\behaviors\file\ActionImage;

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
            [
                ['name', 'description', 'alias', 'meta_title', 'meta_description'],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent id'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_1' => Yii::t('app', 'Image'),
            'image_2' => Yii::t('app', 'Image'),
            'user_id' => Yii::t('app', 'User ID'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/shop/group',
                'pathUrl' => '@web/public/uploads/shop/group',
                'attribute' => 'image_1',
            ],
            'imageContent' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/shop/group',
                'pathUrl' => '@web/public/uploads/shop/group',
                'attribute' => 'image_2',
            ],
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['group_id' => 'id']);
    }

    public function getSubGroups()
    {
        return $this->hasMany(static::className(), ['parent_id' => 'id']);
    }
}
