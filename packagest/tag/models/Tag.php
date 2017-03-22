<?php

namespace kigl\cef\module\tag\models;

use Yii;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends \kigl\cef\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}