<?php

namespace app\modules\shop\models\base;


use Yii;
use app\core\behaviors\UserId;
use app\core\db\ActiveRecord;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%shop_order}}".
 *
 * @property integer $id
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
            [['status', 'user_id', 'postcode'], 'integer'],
            ['sum', 'safe'],
            [['country', 'region', 'city', 'address', 'company', 'phone', 'comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'status' => Yii::t('shop', 'Status'),
            'user_id' => 'User ID',
            'sum' => Yii::t('shop', 'Sum'),
            'country' => Yii::t('shop', 'Country'),
            'region' => Yii::t('shop', 'Region'),
            'city' => Yii::t('shop', 'City'),
            'postcode' => Yii::t('shop', 'Postcode'),
            'address' => Yii::t('shop', 'Address'),
            'company' => Yii::t('shop', 'Company'),
            'phone' => Yii::t('shop', 'Phone'),
            'comment' => Yii::t('shop', 'Comment'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UserId::class,
            ]
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
