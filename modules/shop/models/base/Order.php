<?php

namespace app\modules\shop\models\base;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%shop_order}}".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property ShopCart[] $shopCarts
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'user_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'user_id' => 'User ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasMany(Cart::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
