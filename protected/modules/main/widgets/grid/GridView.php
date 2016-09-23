<?php

namespace app\modules\main\widgets\grid;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;

class GridView extends \yii\grid\GridView
{
	
	public $layout = "{buttons}\n{summary}\n{items}\n{pager}";
	
	public $buttons = [];
	
	public $summaryOptions = ['class' => 'summary pull-right'];
	
	public $options = ['class' => 'grid-view'];
	
	public $tableOptions = ['class' => 'table table-condensed table-striped grid-table'];
	
	public $pager = ['options' => ['class' => 'pagination pull-right']];
	
	public function run()
	{
		$view = $this->getView();
		
		$view->registerJs("
			$('.view-item').click(function() {
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
		
		parent::run();
	}
  
  public function renderSection($name)
  {
      switch ($name) {
      		case '{buttons}':
      				return $this->renderCastomButtons();
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
    
  public function renderCastomButtons()
  {
  	$tag = 'div';
  	$options = ['class' => 'pull-left'];
  	$result = '';
  	
  	if (count($this->buttons) > 0) {   	
    	foreach ($this->buttons as $name => $button) {
				switch ($name) {
					case 'create':
						$result.= $this->getCreateButton();
						break;
				}
			}
		}
  	
		return Html::tag($tag, $result, $options);
	}
	
	protected function getCreateButton()
	{
		$action = Url::to(['create']);
		$text = '<i class="glyphicon glyphicon-plus"></i>';
		$options = ['class' => 'btn btn-success btn-xs'];
		
		if (isset($this->buttons['create']['options'])) {
			$options = ArrayHelper::merge($this->buttons['create']['options'], $options);
		}
		
		if (isset($this->buttons['create']['action'])) {
			return Html::a($text, $this->buttons['create']['action'], $options); 
		}
		
		return Html::a($text, Url::to(['create']), $options);
	}
}
