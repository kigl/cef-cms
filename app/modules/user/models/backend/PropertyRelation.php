<?php

namespace app\modules\user\models\backend;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_property_relation}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $field_id
 * @property string $value
 *
 * @property Property $field
 * @property User $user
 */
class PropertyRelation extends \app\modules\user\models\PropertyRelation
{
    /**
     * Виртуальное поле, не сохраняется
     * Используется для валидации
     * @var
     */
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
            [['requiredValue'], 'safe'],
        ]);
    }
}
