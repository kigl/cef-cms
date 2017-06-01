<?php
/**
 * Class Currence
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use Yii;
use yii\helpers\ArrayHelper;

class Currency extends \app\modules\shop\models\Currency
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['short_name', 'name', 'code'], 'required'],
        ]);
    }

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
    }
}