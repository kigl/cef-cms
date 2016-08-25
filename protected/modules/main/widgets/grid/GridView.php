<?php

namespace app\modules\main\widgets\grid;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

class GridView extends \yii\grid\GridView
{
	
	public $buttons = [];
	
	public function init()
	{	
		$this->options = ['class' => 'panel panel-default grid-view'];
		$this->tableOptions = ['class' => 'table table-bordered table-condensed table-striped'];
		$this->summaryOptions = ['class' => 'summary text-right panel-heading'];
		$this->pager = [
			'options' => ['class' => 'pagination'],
		];
		
		parent::init();
	}
	
	public function initColumns()
	{
		array_unshift($this->columns, 
      ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width: 50px;']]
		);
		
		parent::initColumns();
		
		foreach ($this->columns as $columns) {
			if (is_object($columns) and (!empty($columns->attribute)) and ($columns->attribute == 'id')) {
				$columns->headerOptions = ['style' => 'width: 50px;'];
			}
		}
	}
	
    public function renderItems()
    {
        $caption = $this->renderCaption();
        $columnGroup = $this->renderColumnGroup();
        $castomButton = $this->renderCastomButtons();
        $tableHeader = $this->showHeader ? $this->renderTableHeader() : false;
        $tableBody = $this->renderTableBody();
        $tableFooter = $this->showFooter ? $this->renderTableFooter() : false;
        $content = array_filter([
            $caption,
            $columnGroup,
						$castomButton,
            $tableHeader,
            $tableFooter,
            $tableBody,
        ]);
        return Html::tag('table', implode("\n", $content), $this->tableOptions);
    }
    
    public function renderCastomButtons()
    {
    	$result = '';
    	if (count($this->buttons) > 0) {
	    	$result.= "<div class='text-right' style='padding: 5px'>";
	    	
	    	foreach ($this->buttons as $button) {
					switch ($button) {
						case 'create':
							$result.= Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::to(['create']), ['class' => 'btn btn-success btn-sm']);
							break;
					}
				}
				
				$result.= "</div>";
			}
    	
			return $result;
		}
		
		public function renderPager()
    {
	    $pagination = $this->dataProvider->getPagination();
	    if ($pagination === false || $this->dataProvider->getCount() <= 0) {
	        return '';
	    }
	    /* @var $class LinkPager */
	    $pager = $this->pager;
	    $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
	    $pager['pagination'] = $pagination;
	    $pager['view'] = $this->getView();
	    
	    $result = "<div class='panel-footer'>" . $class::widget($pager) . "</div>";
	    
	    return $result;
    }
}