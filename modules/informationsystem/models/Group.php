<?php

namespace app\modules\informationsystem\models;

use Yii;
use app\modules\informationsystem\models\Informationsystem as System;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "mn_informationsystem_group".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $informationsystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $user_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Group extends \app\core\db\ActiveRecord
{
    const ROOT_GROUP = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%informationsystem_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['parent_id', 'informationsystem_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['name', 'alias', 'meta_title'], 'string', 'max' => 255],
            [['description', 'meta_description'], 'string', 'max' => 300],
            ['image', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('informationsystem', 'ID'),
            'parent_id' => Yii::t('informationsystem', 'Parent ID'),
            'informationsystem_id' => Yii::t('informationsystem', 'Informationsystem ID'),
            'name' => Yii::t('informationsystem', 'Name'),
            'description' => Yii::t('informationsystem', 'Description'),
            'content' => Yii::t('informationsystem', 'Content'),
            'image' => Yii::t('informationsystem', 'Image'),
            'user_id' => Yii::t('informationsystem', 'User ID'),
            'alias' => Yii::t('informationsystem', 'Alias'),
            'meta_title' => Yii::t('informationsystem', 'Meta Title'),
            'meta_description' => Yii::t('informationsystem', 'Meta Description'),
            'create_time' => Yii::t('informationsystem', 'Create Time'),
            'update_time' => Yii::t('informationsystem', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'app\core\behaviors\file\ImageUpload',
                'attribute' => 'image',
                'path' => Yii::$app->getModule('informationsystem')->getPublicPath() . '/images',
                'pathUrl' => Yii::$app->getModule('informationsystem')->getPublicPathUrl() . '/images',
            ],
            [
                'class' => 'app\core\behaviors\GenerateAlias',
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ];
    }

    public function getSubGroups()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['group_id' => 'id']);
    }

    /**
     *    Строит путь с вложениями для виджета Breadcrumbs
     * @param integer $id
     *
     * @return array | false
     */
    public static function buildBreadcrumbs($id = null, $informationsystem_id)
    {
        $modelSystem = System::getSystem($informationsystem_id);

        $result[] = [
            'label' => $modelSystem->name,
            'url' => ['manager/group', 'informationsystem_id' => $informationsystem_id],
        ];

        if ($id !== null and $breadcrumbs = self::recursive($id)) {
            $c = count($breadcrumbs) - 1;
            $breadcrumbs[$c]['last'] = 1;

            foreach ($breadcrumbs as $model) {
                if (!isset($model['last'])) {
                    $result[] = [
                        'label' => $model['name'],
                        'url' => [
                            'manager/group',
                            'parent_id' => $model['id'],
                            'informationsystem_id' => $model['informationsystem_id']
                        ]
                    ];
                } else {
                    $result[] = ['label' => $model['name']];
                }
            }
        }

        return (!empty($result)) ? $result : null;
    }

    /**
     * Рекурсивная функция для построение массива
     * @param integer $id
     *
     * @return array | false
     */
    protected static function recursive($id)
    {
        $model = self::find()
            ->select(['id', 'parent_id', 'name', 'informationsystem_id'])
            ->where('id = :id', [':id' => $id])
            ->asArray()
            ->one();

        if ($model) {
            $result = self::recursive($model['parent_id']);

            $result[] = [
                'id' => $model['id'],
                'parent_id' => $model['parent_id'],
                'name' => $model['name'],
                'informationsystem_id' => $model['informationsystem_id'],
            ];
        }

        return (!empty($result)) ? $result : false;
    }

    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
