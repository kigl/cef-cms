<?php

namespace app\modules\shop\models;


use Yii;
use app\core\behaviors\file\ActionImage;

/**
 * This is the model class for table "{{%shop_producer_group}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $shop_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_preview
 * @property string $image
 * @property integer $sorting
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 */
class ProducerGroup extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_producer_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'shop_id', 'sorting'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [
                ['name', 'alias', 'meta_title', 'meta_description', 'meta_keyword'],
                'string',
                'max' => 255
            ],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image preview'),
            'image' => Yii::t('app', 'Image'),
            'sorting' => Yii::t('app', 'Sorting'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Keyword'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/shop/producer/group',
                'pathUrl' => '@web/public/uploads/shop/producer/group',
                'attribute' => 'image_preview',
            ],
            'image' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/shop/producer/group',
                'pathUrl' => '@web/public/uploads/shop/producer/group',
                'attribute' => 'image',
            ],
        ];
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }
}
