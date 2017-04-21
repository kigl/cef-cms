<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_shop_product_property".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $property_id
 * @property string $value
 */
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
