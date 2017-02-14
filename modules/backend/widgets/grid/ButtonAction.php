<?php

namespace app\modules\backend\widgets\grid;

use Yii;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;

class ButtonAction
{
    const CREATE_BUTTONS_GROUP = 'group';
    const CREATE_BUTTONS_ITEM = 'item';

    public $containerTag = 'div';

    protected $_buttons;

    public function __construct($buttons)
    {
        $this->_buttons = $buttons;
    }

    public function renderButtons()
    {
        $options = ['class' => 'btn-group'];
        $result = '';

        if (count($this->_buttons) > 0) {
            foreach ($this->_buttons as $name => $button) {
                switch ($name) {
                    case 'create':
                        $result .= $this->renderCreateButtons();
                        break;
                }
            }
        }

        return Html::tag($this->containerTag, $result, $options);
    }


    protected function renderCreateButtons()
    {
        $container = 'span';
        $iconPlus = '<i class="glyphicon glyphicon-plus"></i>';
        $linkDropdown = Html::a($iconPlus . " <b class='caret'></b>", '#', [
            'data-toggle' => 'dropdown',
            'class' => 'dropdown-toggle btn btn-success btn-sm',
        ]);
        $result = ['encodeLabels' => false];

        /*
         * @todo
         * Переделать
         */
        foreach ($this->_buttons['create'] as $type => $options) {
            if (is_array($options)) {
                switch ($type) {
                    case self::CREATE_BUTTONS_GROUP :
                        $result['items'][] = $this->getCreateButton($type);
                        break;

                    case self::CREATE_BUTTONS_ITEM :
                        $result['items'][] = $this->getCreateButton($type);
                        break;
                }
            } else {
                switch ($options) {
                    case self::CREATE_BUTTONS_GROUP :
                        $result['items'][] = $this->getCreateButton($options);
                        break;

                    case self::CREATE_BUTTONS_ITEM :
                        $result['items'][] = $this->getCreateButton($options);
                        break;
                }
            }
        }

        return Html::tag($container, $linkDropdown . Dropdown::widget($result));
    }

    protected function getCreateButton($type)
    {
        $action = ['create'];
        $text = Yii::t('backend', "Button create $type");

        if (isset($this->_buttons['create'][$type]['url'])) {
            $action = $this->_buttons['create'][$type]['url'];
        }

        return [
            'label' => $text,
            'url' => $action,
        ];
    }
}