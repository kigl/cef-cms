<?php
/**
 * Class FieldForm
 * @package app\modules\service\modules\form\widgets\frontend\form
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\widgets\frontend\form\forms;


use yii\base\Model;

class FieldForm extends Model
{
    public $value;

    public $required;

    public function rules()
    {
        return [
            ['value', 'required', 'when' => function($model) {
                return $model->required;
            }],
            ['required', 'safe'],
        ];
    }
}