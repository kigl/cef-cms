<?php

namespace app\modules\admin\widgets\grid;

use Yii;
use yii\helpers\Html;
use yii\grid\DataColumn;
use yii\bootstrap\Modal;

class GridView extends \yii\grid\GridView
{
    const TYPE_GROUP = 'group';
    const TYPE_ITEM = 'item';

    public $dataProviderGroup;

    public $columnsGroup;

    public $buttons = [];

    public $layout = "{view}\n{buttons}\n{summary}\n{items}\n<div class='text-right'>{pager}</div>";

    public $summaryOptions = ['class' => 'summary pull-right'];

    public $options = ['class' => 'grid-view'];

    public $tableOptions = ['class' => 'table table-condensed table-striped grid-table'];

    public function renderSection($name)
    {
        switch ($name) {
            case '{view}' :
                return $this->renderViewModal();
            case '{buttons}':
                return $this->renderButtons();
            case '{summary}':
                return $this->renderSummary();
            case '{items}':
                return $this->renderItems();
            case '{pager}':
                return $this->renderPager();
            case '{sorter}':
                return $this->renderSorter();
            default:
                return false;
        }
    }

    public function initColumns()
    {
        /*
         * @todo
         */
        // добавляем колонку тип элемента
        array_unshift($this->columns, $this->getColumnTypeItemAttribute());
        // добавляем колонку id по умолчанию
        array_unshift($this->columns, [
            'attribute' => 'id',
            'headerOptions' => ['style' => 'width: 50px;'],
        ]);

        parent::initColumns();

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

    protected function renderViewModal()
    {
        $view = $this->getView();

        $view->registerJs("
			$('.view-modal-item').click(function() {
					$('.modal').modal('show')
			    var url = $(this).attr('href');
			    var modal = $('.modal-body');
			    $.get(url, function(data) {
			        modal.html(data);
			    });
			    return false;
			});
		");

        echo Modal::widget(['size' => Modal::SIZE_LARGE]);
    }

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

        return "<tbody>\n" . implode("\n", array_merge($rowsGroup, $rows)) . "\n</tbody>";
    }

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

}
