<?php
/**
 * Class RadioListItems
 * @package app\modules\lists\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\lists\widgets;


use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class RadioListItems extends BaseItems
{
    public function run()
    {
        return Html::activeRadioList($this->model, $this->attribute,
            ArrayHelper::map($this->getItems(), 'value', 'value'));
    }
}