<?php
/**
 * Class StatusRbacHelper
 * @package app\modules\user\helpers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\helpers;


use Yii;
use yii\rbac\Item;

class StatusRbacHelper
{
    public static function getStatusList()
    {
        return [
            Item::TYPE_ROLE => Yii::t('user', 'Rbac status role'),
            Item::TYPE_PERMISSION => Yii::t('user', 'Rbac status permission'),
        ];
    }

    public static function getStatus($statusKey)
    {
        return self::getStatusList()[$statusKey];
    }
}