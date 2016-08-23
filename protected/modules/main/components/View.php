<?php

namespace app\modules\main\components;

class View extends \yii\web\View
{
	public $pageTitle;

	public $pageDescription;

	public $toolbar;

	public $breadcrumbs;
	
	public $pageHeader;

	public function setPageTitle($title)
	{
		$this->pageTitle = $title;
	}

	public function getPageTitle()
	{
		return $this->pageTitle;
	}

	public function setPageDescription($description)
	{
		$this->pageDescription = $description;
	}

	public function getPageDescription()
	{
		return $this->pageDescription;
	}
} 