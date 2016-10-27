<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 */
class Property extends \app\components\ActiveRecord
{
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
        ];
    }
}
