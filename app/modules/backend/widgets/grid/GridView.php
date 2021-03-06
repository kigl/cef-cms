<?php

namespace app\modules\backend\widgets\grid;


use Yii;
use yii\helpers\ArrayHelper;

class GridView extends \kartik\grid\GridView
{
    const TYPE_GROUP = 'group';
    const TYPE_ITEM = 'item';

    public $buttons = [];

    public $buttonOptions = [];

    public $toolbar = [
        '{buttons}',
        //'{export}',
    ];

    public $panelBeforeTemplate = '
        <div class="pull-left">
            <div class="btn-toolbar kv-grid-toolbar" role="toolbar">
                {toolbar}
            </div>  
        </div>
        {before}
        <div class="clearfix"></div>
        ';


    public $panel = [
        'type' => 'default',
    ];

    public $condensed = true;

    public $bordered = false;

    public $hover = true;

    public $summaryOptions = ['class' => 'summary pull-right'];

    public function run()
    {
        GridViewAsset::register($this->getView());

        parent::run();
    }

    public function renderSection($name)
    {
        switch ($name) {
            case '{buttons}':
                return $this->renderButtons();
            default:
                return parent::renderSection($name);
        }
    }

    protected function initColumns()
    {
        array_unshift($this->columns, $this->getSerialColumn());

        // добавляем стиль, если есть коллонка id
        if ($keyId = array_search('id', $this->columns)) {
            $this->columns[$keyId] = [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 5%'],
            ];
        }

        parent::initColumns();
    }

    /**
     * @return string
     */
    public function renderButtons()
    {
        $button = Yii::createObject(ArrayHelper::merge(
            [
                'class' => ButtonAction::class,
                'buttons' => $this->buttons,
            ], $this->buttonOptions));

        return $button->renderButtons();
    }

    protected function getSerialColumn()
    {
        return [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'width: 3%;'],
        ];
    }
}
