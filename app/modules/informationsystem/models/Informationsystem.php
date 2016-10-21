<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_informationsystem".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $status
 * @property integer $sort
 * @property string $meta_title
 * @property string $meta_description
 * @property string $template
 * @property integer $user_id
 * @property integer $items_on_page
 * @property integer $create_time
 * @property integer $update_time
 */
class Informationsystem extends \yii\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informationsystem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['status', 'sort', 'user_id', 'items_per_page', 'create_time', 'update_time'], 'integer'],
            [['template'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
            ['image', 'file'],
            ['items_per_page', 'default', 'value' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('informationsystem', 'ID'),
            'name' => Yii::t('informationsystem', 'Name'),
            'description' => Yii::t('informationsystem', 'Description'),
            'content' => Yii::t('informationsystem', 'Content'),
            'image' => Yii::t('informationsystem', 'Image'),
            'status' => Yii::t('informationsystem', 'Status'),
            'sort' => Yii::t('informationsystem', 'Sort'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'user_id' => Yii::t('informationsystem', 'User id'),
            'items_per_page' => Yii::t('informationsystem', 'Items per page'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new Expression('NOW()'),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            [
                'class' => 'app\components\behaviors\file\ImageUpload',
                'attribute' => 'image',
                'path' => Yii::$app->controller->module->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->controller->module->getPublicPathUrl() . '/images',
            ]
        ];
    }

    public function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('informationsystem', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('informationsystem', 'Status active'),
        ];
    }

    public function getStatus($id)
    {
        return ArrayHelper::getValue($this->getStatusList(), $id);
    }

    public static function getSystem($id, $type = 'object')
    {
        $model = self::find()->where('id = :id', [':id' => $id]);

        if ($type === 'array') {
            $model->asArray();
        }

        $result = $model->one();

        if ($result) {
            return $result;
        }
        return false;
    }
}
