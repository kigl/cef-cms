<?php

namespace app\modules\shop\models;


use Yii;
use app\core\behaviors\UserId;
use app\core\db\ActiveRecord;
use app\modules\users\models\User;

/**
 * This is the model class for table "{{%shop_order}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $status
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 * @property number $sum
 *
 * @property Cart[] $shopCarts
 * @property User $user
 */
class Order extends ActiveRecord
{
    const STATUS_NOT_ACCEPTED = 0;
    const STATUS_ACCEPTED = 1;

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
            [['shop_id'], 'required'],
            [['shop_id', 'status', 'user_id', 'postcode'], 'integer'],
            ['sum', 'safe'],
            [['country', 'region', 'city', 'address', 'company', 'phone', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User id'),
            'sum' => Yii::t('shop', 'Sum'),
            'country' => Yii::t('app', 'Country'),
            'region' => Yii::t('app', 'Region'),
            'city' => Yii::t('app', 'City'),
            'postcode' => Yii::t('app', 'Postcode'),
            'address' => Yii::t('app', 'Address'),
            'company' => Yii::t('app', 'Company'),
            'phone' => Yii::t('app', 'Phone'),
            'comment' => Yii::t('app', 'Comment'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
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

    public function getFieldRelation()
    {
        return $this->hasMany(OrderFieldRelation::className(), ['order_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
}
