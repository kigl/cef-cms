<?php

namespace app\modules\main\widgets\grid;

class GridView extends \yii\grid\GridView
{
	public function init()
	{	
		$this->tableOptions = ['class' => 'table table-bordered table-condensed table-striped'];
		$this->summaryOptions = ['class' => 'summary text-right'];
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
}