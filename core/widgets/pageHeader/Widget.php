<?php
/**
 * Class Widget
 * @package app\core\widgets\pageHeader
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets\pageHeader;

use Yii;
use yii\helpers\Html;

class Widget extends \yii\base\Widget
{
    protected $defaultOptions = ['class' => 'page-header'];

    public $options = [];

    public $text = '';

    public function run()
    {
        Html::addCssClass($this->options, $this->defaultOptions);

        if ($this->text !== '') {
            echo Html::tag('div', Html::tag('h4', $this->text), $this->options);
        }
    }
}