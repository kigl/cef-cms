<?php
/**
 * Class StatusHelper
 * @package app\modules\user\helpers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\helpers;


use Yii;
use app\modules\user\models\User;

class StatusHelper
{
    public static function getList()
    {
        return [
            User::STATUS_BLOCK => Yii::t('user', 'Status block'),
            User::STATUS_ACTIVE => Yii::t('user', 'Status active'),
            User::STATUS_NOT_ACTIVE => Yii::t('user', 'Status not active'),
        ];
    }

    public static function get($status)
    {
        return self::getList()[$status];
    }
}