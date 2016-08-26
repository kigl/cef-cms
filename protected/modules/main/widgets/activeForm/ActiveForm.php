<?php

namespace app\modules\main\widgets\activeForm;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveFormAsset;

class ActiveForm extends \yii\widgets\ActiveForm
{
	public $buttonSave = true;
	
	public $options = ['class' => 'well well-sm'];
	
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
					$buttonSave = Html::submitButton(Yii::t('main', 'button save'), ['class' => 'btn btn-success btn-sm']);
					
					echo Html::tag('div', $buttonSave, $options);
				}
        
        echo Html::endForm();
    }
}