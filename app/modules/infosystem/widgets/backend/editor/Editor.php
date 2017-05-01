<?php
namespace app\modules\infosystem\widgets\backend\editor;


use yii\widgets\InputWidget;
use yii\helpers\Html;

class Editor extends InputWidget {

    public function run()   {
        $view = $this->getView();

        $asset = new Asset();
        $asset->register($view);

        $id = $this->getId();
        $this->options['id'] = $id;

        $view->registerJs("jQuery('#$id').tagEditor();");

        return $this->hasModel() ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);
    }
}