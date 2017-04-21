<?php

namespace app\modules\infosystem\models\backend;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%infosystem_item_property}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $property_id
 * @property string $value
 *
 * @property Item $item
 * @property Property $property
 */
class ItemProperty extends \app\modules\infosystem\models\ItemProperty
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
