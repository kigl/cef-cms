<?php

namespace app\modules\main\widgets\backend;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveFormAsset;
use yii\db\ActiveRecord;

class ActiveForm extends \yii\widgets\ActiveForm
{
	public $buttonSave = true;
	
	public $enableClientValidation = true;
	
	public $fieldConfig = ['template' => "{label}\n{input}"];
	
	public $options = ['class' => 'well well-sm'];
	
	public $errorSummaryCssClass = 'error-simmary alert alert-danger';
	
    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }
        $content = ob_get_clean();
        
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
        
        if ($this->buttonSave) {
        	$options = ['class' => 'panel-footer'];
					$buttonSave = Html::submitButton(Yii::t('main', 'Button save'), ['class' => 'btn btn-success btn-sm']);
					
					echo Html::tag('div', $buttonSave, $options);
				}
        
        echo Html::endForm();
    }
}