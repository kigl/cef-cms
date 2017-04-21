<?php

namespace app\modules\backend\widgets\grid;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\DataColumn;
use yii\bootstrap\Modal;

class GridView extends \kartik\grid\GridView
{
    const TYPE_GROUP = 'group';
    const TYPE_ITEM = 'item';

    public $dataProviderGroup;

    public $columnsGroup;

    public $buttons = [];

    public $buttonOptions = [];

    public $toolbar = [
        '{buttons}',
        //'{export}',
    ];

    public $checkboxColumn = false;

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

    public function run() {
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
        // добавляем колонку тип элемента
        array_unshift(
            $this->columns,
            $this->getColumnType(self::TYPE_ITEM)
        );

        if ($this->checkboxColumn) {
            array_unshift($this->columns, [
                'class' => CheckboxItemColumn::className(),
                'headerOptions' => ['style' => 'width: 50px'],
            ]);
        }

        array_unshift($this->columns, $this->getSerialColumn());

        // добавляем стиль, если есть коллонка id
        if ($keyId = array_search('id', $this->columns)) {
            $this->columns[$keyId] = [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 80px'],
            ];
        }

        parent::initColumns();

        $this->initColumnsGroup();
    }

    protected function initColumnsGroup()
    {
        if (!empty($this->columnsGroup)) {

            array_unshift(
                $this->columnsGroup,
                $this->getColumnType(self::TYPE_GROUP)
            );

            if ($this->checkboxColumn) {
                array_unshift($this->columnsGroup, [
                    'class' => CheckboxGroupColumn::className(),
                ]);
            }

            array_unshift($this->columnsGroup, $this->getSerialColumn());

            foreach ($this->columnsGroup as $i => $column) {
                if (is_string($column)) {
                    $column = $this->createDataColumn($column);
                } else {
                    $column = Yii::createObject(array_merge([
                        'class' => $this->dataColumnClass ?: DataColumn::className(),
                        'grid' => $this,
                    ], $column));
                }
                if (!$column->visible) {
                    unset($this->columns[$i]);
                    continue;
                }
                $this->columnsGroup[$i] = $column;
            }
        }
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

    /**
     * Renders the table body.
     * @return string the rendering result.
     */
    public function renderTableBody()
    {
        $models = array_values($this->dataProvider->getModels());
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];
            if ($this->beforeRow !== null) {
                $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $rows[] = $this->renderTableRow($model, $key, $index);

            if ($this->afterRow !== null) {
                $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }
        }

        $rowsGroup = [];
        if (!empty($this->dataProviderGroup)) {
            $modelsGroup = array_values($this->dataProviderGroup->getModels());
            $keysGroup = $this->dataProviderGroup->getKeys();
            $rowsGroup = [];

            foreach ($modelsGroup as $index => $model) {
                $key = $keysGroup[$index];
                if ($this->beforeRow !== null) {
                    $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                    if (!empty($row)) {
                        $rowsGroup[] = $row;
                    }
                }

                $rowsGroup[] = $this->renderTableRowGroups($model, $key, $index);

                if ($this->afterRow !== null) {
                    $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                    if (!empty($row)) {
                        $rowsGroup[] = $row;
                    }
                }
            }
        }

        if (empty($rows)) {
            $colspan = count($this->columns);

            $rows[] = "<tr><td colspan=\"$colspan\">" . $this->renderEmpty() . "</td></tr>\n</tbody>";
        }

        $content = "<tbody>\n" . implode("\n", array_merge($rowsGroup, $rows)) . "\n</tbody>";

        if ($this->showPageSummary) {
            return $content . $this->renderPageSummary();
        }
        return $content;
    }

    /**
     * @param $model
     * @param $key
     * @param $index
     * @return string
     */
    public function renderTableRowGroups($model, $key, $index)
    {
        $cells = [];
        /* @var $column Column */
        foreach ($this->columnsGroup as $column) {
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        if ($this->rowOptions instanceof Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['data-key'] = is_array($key) ? json_encode($key) : (string)$key;

        return Html::tag('tr', implode('', $cells), $options);
    }

    /**
     * @return array
     */
    protected function getColumnType($type)
    {
        return [
            'headerOptions' => ['style' => 'width: 50px;'],
            'format' => 'raw',
            'value' => function ($data) use ($type) {
                return $this->getIconRow($type);
            }
        ];
    }

    /**
     * @param $type
     * @return string
     */
    protected function getIconRow($type)
    {
        switch ($type) {
            case self::TYPE_GROUP :
                return "<i class='fa fa-folder'></i>";
                break;
            case self::TYPE_ITEM :
                return "<i class='fa fa-file-text-o'></i>";
                break;
        }
    }

    protected function getSerialColumn()
    {
        return [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'width: 50px;'],
        ];
    }
}
