<?php

namespace app\modules\shop\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;

/**
 * This is the model class for table "mn_shop_group".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $image_small
 * @property integer $status
 * @property integer $sort
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Group extends \app\modules\shop\models\base\Group
{
    const ROOT_GROUP = 0;

    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            [
                'class' => GenerateAlias::class,
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['group_id' => 'id']);
    }

    public function getSubGroups()
    {
        return $this->hasMany(static::className(), ['parent_id' => 'id']);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('shop', 'Status active'),
            self::STATUS_BLOCK => Yii::t('shop', 'Status block'),
        ];
    }

    public function getStatus($key)
    {
        return ArrayHelper::getValue($this->getStatusList(), $key);
    }
}
