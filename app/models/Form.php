<?php
/**
 * Class Form
 * @package app\modules
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\models;


use yii\base\Model;

class Form extends Model
{
    public $number;

    public function rules()
    {
        return [
            ['number', 'validateNumber'],
        ];
    }

    public function validateNumber($attribute, $params)
    {
        if ($this->{$attribute} != '') {
            $this->addError($attribute, 'not integer');
        }
    }
}