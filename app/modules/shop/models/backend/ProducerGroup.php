<?php
/**
 * Class ProducerGroup
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class ProducerGroup extends \app\modules\shop\models\ProducerGroup
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'required'],
        ]);
    }
}