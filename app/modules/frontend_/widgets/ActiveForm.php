<?php

namespace app\modules\frontend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\widgets\ActiveFormAsset;


class ActiveForm extends \yii\bootstrap\ActiveForm
{
    public $fieldConfig = ['template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}\n{hint}"];

    public $defaultOptions = [];

    public $errorSummaryCssClass = 'error-summary alert alert-danger';

    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }
        $content = ob_get_clean();

        echo Html::beginForm($this->action, $this->method, ArrayHelper::merge($this->defaultOptions, $this->options));
        echo $content;
        if ($this->enableClientScript) {
            $id = $this->options['id'];
            $options = Json::htmlEncode($this->getClientOptions());
            $attributes = Json::htmlEncode($this->attributes);
            $view = $this->getView();
            ActiveFormAsset::register($view);
            $view->registerJs("jQuery('#$id').yiiActiveForm($attributes, $options);");
        }


        $options = ['class' => 'form-group'];
        $buttonSave = Html::submitButton(Yii::t('app', 'Button save'), ['class' => 'btn btn-success btn-sm']);

        echo Html::tag('div', $buttonSave, $options);

        echo Html::endForm();
    }
}