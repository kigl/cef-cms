<?php

namespace app\modules\shop\models\base;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 */
class Property extends ActiveRecord
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
}
