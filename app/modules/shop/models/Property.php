<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property integer $shop_id
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
            [['name'], 'string', 'max' => 255],
            [['shop_id', 'type', 'required', 'list_id'], 'integer'],
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
            'type' => Yii::t('app', 'Property type'),
            'list_id' => Yii::t('app', 'List'),
            'sorting' => Yii::t('app', 'Sorting'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
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

    public function getType($type)
    {
        return $this->getListType()[$type];
    }
}
