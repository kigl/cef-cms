<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_producer}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $group_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_preview
 * @property string $image
 * @property integer $sorting
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 */
class Producer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_producer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'group_id', 'sorting'], 'integer'],
            [['content'], 'string'],
            [['name', 'image_preview', 'image', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],
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
            'shop_id' => Yii::t('app', 'Shop ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image Preview'),
            'image' => Yii::t('app', 'Image'),
            'sorting' => Yii::t('app', 'Sorting'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Keyword'),
        ];
    }
}
