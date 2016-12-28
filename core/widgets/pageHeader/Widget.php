<?php
/**
 * Class Widget
 * @package app\core\widgets\pageHeader
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets\pageHeader;

use Yii;
use yii\helpers\ArrayHelper;

class Widget extends \yii\base\Widget
{
    protected $defaultOptions = ['class' => 'page-header'];

    public $options = [];

    public $text = '';

    public function run()
    {
        return $this->render('index', [
            'options' => ArrayHelper::merge($this->defaultOptions, $this->options),
            'header' => $this->text,
        ]);
    }
}