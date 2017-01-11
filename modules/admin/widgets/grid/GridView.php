<?php

namespace app\modules\admin\widgets\grid;

use app\modules\shop\models\Group;
use Yii;
use yii\helpers\Html;
use yii\grid\DataColumn;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;

class GridView extends \yii\grid\GridView
{
    const TYPE_GROUP = 'group';
    const TYPE_ITEM = 'item';

    public $dataProviderGroup;

    public $columnsGroup;

    public $buttons = [];

    public $layout = "{views}\n{buttons}\n{summary}\n{items}\n<div class='text-right'>{pager}</div>";

    public $summaryOptions = ['class' => 'summary pull-right'];

    /*
    /**
     * ...
     *  [
     *      'breadcrumbsGroup' => [
     *          'parent_id' => $parent_id,
     *          'modelClass' => Group::className(),
     *          'urlOptions' => [
     *              'route' => 'controller/action',
     *              'queryParams' => [
     *                  'query' => 'views'
     *              ],
     *      ],
     * ]
     * ..
     * @var

    public $breadcrumbsGroup;
    */

    public $options = ['class' => 'grid-views'];

    public $tableOptions = ['class' => 'table table-condensed table-striped grid-table'];

    public function renderSection($name)
    {
        switch ($name) {
            case '{views}' :
                return $this->renderViewModal();
            case '{buttons}':
                return $this->renderButtons();
            case '{summary}':
                return $this->renderSummary();
            /* case '{breadcrumbsGroup}' :
                 return $this->renderBreadcrumbsGroup();
            */
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

    protected function renderViewModal()
    {
        $view = $this->getView();

        $view->registerJs("
			$('.views-modal-item').click(function() {
					$('.modal').modal('show')
			    var url = $(this).attr('href');
			    var modal = $('.modal-body');
			    $.get(url, function(data) {
			        modal.html(data);
			    });
			    return false;
			});
		");

        return Modal::widget(['size' => Modal::SIZE_LARGE]);
    }

    /*
    public function renderBreadcrumbsGroup()
    {
        $breadcrumbs = new BreadcrumbsGroup();

        if (isset($this->breadcrumbsGroup)) {
            return Breadcrumbs::widget([
                'links' => $breadcrumbs->getGroup(
                    $this->breadcrumbsGroup['parent_id'],
                    $this->breadcrumbsGroup['urlOptions'],
                    $this->breadcrumbsGroup['modelClass']
                ),
                'homeLink' => false,
                'options' => ['class' => 'clear-both no-margin breadcrumb small'],
            ]);
        }

        return null;
    }
    */

    /**
     * @return string
     */
    public function renderButtons()
    {
        $button = new ButtonAction($this->buttons);

        return $button->renderButtons();
    }

    /**
     * Renders the data models for the grid views.
     */
    public function renderItems()
    {
        $caption = $this->renderCaption();
        $columnGroup = $this->renderColumnGroup();
        $tableHeader = $this->showHeader ? $this->renderTableHeader() : false;
        $tableBody = $this->renderTableBody();
        $tableFooter = $this->showFooter ? $this->renderTableFooter() : false;
        $content = array_filter([
            $caption,
            $columnGroup,
            $tableHeader,
            $tableFooter,
            $tableBody,
        ]);

        return Html::tag('table', implode("\n", $content), $this->tableOptions);
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
