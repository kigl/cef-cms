<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class ProductProperty extends \app\modules\shop\models\ProductProperty
{
    public $name;

    public $requiredValue;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['value', 'required', 'when' => function ($model) {
                return $model->requiredValue;
            }],
            [['requiredValue', 'name'], 'safe'],
        ]);
    }
}
