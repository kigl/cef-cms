<?php

namespace kigl\cef\module\shop\models;

use Yii;
use kigl\cef\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $required
 */
class Property extends ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_CHECKBOX = 2;
    const TYPE_TEXTAREA = 3;
    const TYPE_SELECT = 4;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'string', 'max' => 255],
            [['type', 'required'], 'integer'],
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
            'type' => Yii::t('app', 'Property type'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    public function getListType()
    {
        return [
            self::TYPE_STRING => Yii::t('app', 'Type field text'),
            self::TYPE_CHECKBOX => Yii::t('app', 'Type field checkbox'),
            self::TYPE_TEXTAREA => Yii::t('app', 'Type field textarea'),
            self::TYPE_SELECT => Yii::t('app', 'Type field select'),
        ];
    }
}
