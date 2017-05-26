<?php

namespace app\modules\infosystems\models\backend;


use yii\helpers\ArrayHelper;

class ItemProperty extends \app\modules\infosystems\models\ItemProperty
{
    /**
     * Виртуальное поля, используется для валидации
     * @var
     */
    public $requiredValue;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
            ['value', 'required', 'when' => function ($model) {
                return $model->requiredValue;
            }],
        ]);
    }
}
