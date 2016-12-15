<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "b_catalog_discount_coupon".
 *
 * @property integer $ID
 * @property integer $DISCOUNT_ID
 * @property string $ACTIVE
 * @property string $COUPON
 * @property string $DATE_APPLY
 * @property string $ONE_TIME
 * @property string $DESCRIPTION
 * @property string $TIMESTAMP_X
 * @property integer $MODIFIED_BY
 * @property string $DATE_CREATE
 * @property integer $CREATED_BY
 */
class sCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_catalog_discount_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISCOUNT_ID', 'COUPON'], 'required'],
            [['DISCOUNT_ID', 'MODIFIED_BY', 'CREATED_BY'], 'integer'],
            [['DATE_APPLY', 'TIMESTAMP_X', 'DATE_CREATE'], 'safe'],
            [['DESCRIPTION'], 'string'],
            [['ACTIVE', 'ONE_TIME'], 'string', 'max' => 1],
            [['COUPON'], 'string', 'max' => 32],
            [['DISCOUNT_ID', 'COUPON'], 'unique', 'targetAttribute' => ['DISCOUNT_ID', 'COUPON'], 'message' => 'The combination of Discount  ID and Coupon has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DISCOUNT_ID' => 'Discount  ID',
            'ACTIVE' => 'Active',
            'COUPON' => 'Coupon',
            'DATE_APPLY' => 'Date  Apply',
            'ONE_TIME' => 'One  Time',
            'DESCRIPTION' => 'Description',
            'TIMESTAMP_X' => 'Timestamp  X',
            'MODIFIED_BY' => 'Modified  By',
            'DATE_CREATE' => 'Date  Create',
            'CREATED_BY' => 'Created  By',
        ];
    }

    public function getOneItem()
    {
        $model = self::find()->
    }

    public function getNumberCoupon()
    {
        return "CP-" . strtoupper(mb_substr(sha1($this->getRandNumber()), 0 , 15));
    }

    public function getRandNumber($start = 20, $end = 9999999)
    {
        return rand($start, $end);
    }

    public function crateCoupon($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $model = new $this;
            $model->attributes = [
                'DISCOUNT_ID' => 1,
                'ACTIVE' => 'Y',
                'COUPON' => $model->getNumberCoupon(),
                'ONE_TIME' => 'Y',
                'TIMESTAMP_X' => '2016-12-09 07:36:53',
                'MODIFIED_BY' => 1,
                'DATE_CREATE' => '2016-12-09 07:36:53',
                'CREATED_BY' => 1,
            ];
            $model->save(false);
        }
    }
}
