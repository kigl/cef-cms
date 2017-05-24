<?php

namespace app\modules\backend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveFormAsset;

class ActiveForm extends \yii\bootstrap\ActiveForm
{
    public $fieldConfig = ['template' => "{label}\n{input}"];

    public $defaultCss = 'well well-sm';

    public $errorSummaryCssClass = 'error-summary alert alert-danger';

    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }
        $content = ob_get_clean();

        Html::addCssClass($this->options, $this->defaultCss);

        echo Html::beginForm($this->action, $this->method, $this->options);
        echo $content;
        if ($this->enableClientScript) {
            $id = $this->options['id'];
            $options = Json::htmlEncode($this->getClientOptions());
            $attributes = Json::htmlEncode($this->attributes);
            $view = $this->getView();
            ActiveFormAsset::register($view);
            $view->registerJs("jQuery('#$id').yiiActiveForm($attributes, $options);");
        }


        $options = ['class' => 'panel-footer'];
        $buttonSave = Html::submitButton(Yii::t('app', 'Button save'), ['class' => 'btn btn-success btn-sm']);

        echo Html::tag('div', $buttonSave, $options);

        echo Html::endForm();
    }
}