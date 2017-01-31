<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "mn_informationsystem".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Informationsystem extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%informationsystem}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 300],
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
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function getItemGroups()
    {
        return $this->hasMany(Group::className(), ['informationsystem_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['informationsystem_id' => 'id']);
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
