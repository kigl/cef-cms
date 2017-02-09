<?php
/**
 * Class FieldForm
 * @package app\modules\service\modules\form\widgets\frontend\form
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\widgets\frontend\form\forms;


use Yii;
use yii\base\Model;

class FieldForm extends Model
{
    public $value;

    public $required;

    public $sorting;

    public $captcha;

    public $verifyCode;

    public function rules()
    {
        return [
            ['value', 'required', 'when' => function($model) {
                return $model->required;
            }],
            ['verifyCode', 'captcha', 'captchaAction' => '/frontend/site/captcha', 'when' => function ($model) {
                 return $model->captcha;
            }],
            [['required', 'sorting'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => Yii::t('app', 'Value'),
        ];
    }
}