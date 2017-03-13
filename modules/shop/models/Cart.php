<?php

namespace app\modules\shop\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%shop_cart}}".
 *
 * @property integer $id
 * @property integer $user_id
 *
 * @property User $user
 * @property CartItem[] $shopCartItems
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'user_id' => Yii::t('shop', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(CartItem::className(), ['cart_id' => 'id']);
    }
}
