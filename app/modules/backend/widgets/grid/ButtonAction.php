<?php

namespace app\modules\backend\widgets\grid;

use Yii;
use yii\base\Object;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;

class ButtonAction extends Object
{
    const ACTION_CREATE = 'create';
    const ACTION_DELETE = 'delete';

    const GROUP = 'group';
    const ITEM = 'item';

    public $buttons = [];

    public $buttonContainerTag = 'div';

    public $buttonContainerOptions = ['class' => 'btn-group'];

    public $buttonSize = 'btn-xs';

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function renderButtons()
    {
        $result = '';

        if (count($this->buttons) > 0) {
            foreach ($this->buttons as $name => $button) {
                switch ($name) {
                    case self::ACTION_CREATE :
                        $result .= $this->renderButton(self::ACTION_CREATE);
                        break;
                    case self::ACTION_DELETE :
                        $result .= $this->renderButton(self::ACTION_DELETE);
                        break;
                }
            }
        }
        return $result;
    }


    protected function renderButton($action)
    {
        /*
         * @todo
         * Улучшить
         */
        $linkDropdown = Html::a($this->getIcon($action) . " <b class='caret'></b>", '#', [
            'data-toggle' => 'dropdown',
            'class' => 'dropdown-toggle ' . $this->getButtonCssClass($action),
        ]);
        $result = ['encodeLabels' => false];

        foreach ($this->buttons[$action] as $type => $options) {
            if (is_array($options)) {
                switch ($type) {
                    case self::GROUP :
                        $result['items'][] = $this->getButton($action, $type);
                        break;

                    case self::ITEM :
                        $result['items'][] = $this->getButton($action, $type);
                        break;
                }
            }
        }

        return Html::tag($this->buttonContainerTag, $linkDropdown . Dropdown::widget($result),
            $this->buttonContainerOptions);
    }

    protected function getButton($action, $type)
    {
        $result = [
            'label' => Yii::t('app', "Button $action $type"),
            'url' => isset($this->buttons[$action][$type]['url']) ? $this->buttons[$action][$type]['url'] : $action,
        ];
        $linkOptions = [];

        if ($action == self::ACTION_CREATE) {
            $linkOptions = !empty($this->buttons[$action][$type]['linkOptions'])
                ? $this->buttons[$action][$type]['linkOptions'] : null;

        } elseif ($action == self::ACTION_DELETE) {

            $cssClass = 'selection-' . $type . '-' . $action;
            $linkOptions = ['class' => $cssClass];
        }

        $result['linkOptions'] = $linkOptions;

        return $result;
    }

    protected function getButtonCssClass($action)
    {
        $buttonCssClass = 'btn';

        if ($action == self::ACTION_CREATE) {
            $buttonCssClass .= ' btn-success';
        } elseif ($action == self::ACTION_DELETE) {
            $buttonCssClass .= ' btn-danger';
        } else {
            $buttonCssClass .= ' btn-default';
        }

        $buttonCssClass .= ' ' . $this->buttonSize;

        return $buttonCssClass;
    }

    protected function getIcon($action)
    {
        $tag = 'i';
        $iconCssClass = '';

        switch ($action) {
            case self::ACTION_CREATE :
                $iconCssClass = 'fa fa-plus';
                break;
            case self::ACTION_DELETE :
                $iconCssClass = 'fa fa-minus';
                break;
        }

        return Html::tag($tag, '', ['class' => $iconCssClass]);

    }
}