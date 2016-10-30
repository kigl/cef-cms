<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 */
class Property extends \app\components\ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_BOOLEAN = 2;

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
            ['type', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'Id'),
            'name' => Yii::t('shop', 'Name'),
            'type' => Yii::t('shop', 'Property type'),
        ];
    }

    public function getListType()
    {
        return [
            self::TYPE_STRING => Yii::t('shop', 'Property type string'),
            self::TYPE_BOOLEAN => Yii::t('shop', 'Property type boolean'),
        ];
    }
}
