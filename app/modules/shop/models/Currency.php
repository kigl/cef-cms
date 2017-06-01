<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_currency}}".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $name
 * @property string $code
 * @property string $exchange_rate
 *
 * @property Shop[] $shops
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_currency}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_rate'], 'number'],
            [['short_name', 'name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_name' => Yii::t('app', 'Short Name'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shop::className(), ['currency_id' => 'id']);
    }
}
