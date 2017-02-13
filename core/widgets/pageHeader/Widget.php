<?php
/**
 * Class Widget
 * @package app\core\widgets\pageHeader
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets\pageHeader;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Widget extends \yii\base\Widget
{
    protected $defaultOptions = ['class' => 'page-header'];

    public $options = [];

    public $text = '';

    public function run()
    {
        if ($this->text !== '') {
            echo Html::tag('h1', $this->text, ArrayHelper::merge($this->defaultOptions, $this->options));
        }
    }
}