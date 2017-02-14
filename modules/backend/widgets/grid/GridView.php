<?php

namespace app\modules\backend\widgets\grid;


use Yii;
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

    public $toolbar = [
        '{buttons}',
        '{export}',
    ];

    public $exportContainer = [
        'class' => 'btn-group-sm'
    ];

    public $panel = [
        'type' => 'default',
    ];

    public $bordered = false;


    public $summaryOptions = ['class' => 'summary pull-right'];


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
        /*
         * @todo
         */
        // добавляем колонку тип элемента
        array_unshift($this->columns, $this->getColumnTypeItemAttribute());

        $this->editColumnId($this->columns);

        parent::initColumns();

       $this->initColumnsGroup();

    }

    protected function initColumnsGroup()
    {
        if (!empty($this->columnsGroup)) {
            /*
             * @todo
             */
            // добавляем колонку тип элемента
            array_unshift($this->columnsGroup, $this->getColumnTypeGroupAttribute());
            // добавляем колонку id по умолчанию
            array_unshift($this->columnsGroup, 'id');

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
        $button = new ButtonAction($this->buttons);

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
     * @param $type
     * @return string
     */
    protected function getIconColumnType($type)
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

    /**
     * @return array
     */
    protected function getColumnTypeItemAttribute()
    {
        return [
            'format' => 'raw',
            'headerOptions' => ['style' => 'width: 50px'],
            'value' => function ($data) {
                return $this->getIconColumnType(self::TYPE_ITEM);
            }
        ];
    }

    protected function getColumnTypeGroupAttribute()
    {
        return [
            'format' => 'raw',
            'value' => function ($data) {
                return $this->getIconColumnType(self::TYPE_GROUP);
            }
        ];
    }

    protected function editColumnId(&$columns)
    {
        $arrayFilter = array_filter($columns, function ($value) {
            return $value === 'id';
        });
        $keyArrayFilter = key($arrayFilter);

        if ($arrayFilter) {
            unset($columns[$keyArrayFilter]);

            array_unshift($columns, [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 50px;'],
            ]);
        }
    }
}
