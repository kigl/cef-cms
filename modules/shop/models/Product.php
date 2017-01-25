<?php

namespace app\modules\shop\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\core\behaviors\GenerateAlias;
use app\core\behaviors\UserId;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $sku
 * @property string $price
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Product extends \app\modules\shop\models\base\Product
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCK = 0;

    public $imageUpload;

    public function behaviors()
    {
        return [
            [
                'class' => GenerateAlias::className(),
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => UserId::className(),
                'attribute' => 'user_id',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getListStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('shop', 'Status active'),
            self::STATUS_BLOCK => Yii::t('shop', 'Status block'),
        ];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getStatus($key)
    {
        return ArrayHelper::getValue($this->getListStatus(), $key);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(ProductProperty::className(), ['product_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModification()
    {
        return $this->hasMany(ProductModification::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentProductModification()
    {
        return $this->hasOne(ProductModification::className(), ['product_modification_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    /**
     * @todo
     * ненравится присутствие в модели, служит только
     * для формирования массива для представления
     * @return array
     */
    public function getListProductInGroup()
    {
        return self::find()
            ->where('group_id = :group', ['group' => $this->group_id])
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    /**
     * @todo функция должна находиться в сервисе представления
     * @param string $route
     * @return string
     */
    public function getUrl($route = "/shop/product/view")
    {
        return Url::to([$route, 'id' => $this->id, 'alias' => $this->alias]);
    }

    public function getMainImage()
    {
        return $this->hasOne(Image::className(), ['product_id' => 'id'])
            ->where(['status' => Image::STATUS_MAIN]);
    }
}
