<?php

namespace app\modules\lists\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%list}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 *
 * @property ListItem[] $listItems
 */
class Lists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['list_id' => 'id']);
    }
}
