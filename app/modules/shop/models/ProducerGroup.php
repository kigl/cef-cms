<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_producer_group}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $name
 * @property string $image_preview
 * @property string $image
 * @property string $description
 * @property integer $sorting
 */
class ProducerGroup extends \yii\db\ActiveRecord
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
            [['shop_id', 'sorting'], 'integer'],
            [['name', 'image_preview', 'image'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'image_preview' => Yii::t('app', 'Image Preview'),
            'image' => Yii::t('app', 'Image'),
            'description' => Yii::t('app', 'Description'),
            'sorting' => Yii::t('app', 'Sorting'),
        ];
    }
}
