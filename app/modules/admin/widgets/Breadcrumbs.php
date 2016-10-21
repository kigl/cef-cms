<?php

namespace app\modules\admin\widgets;

use Yii;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
	/**
	* @var скрытые модули 
	*/
	public $hidenModules = ['admin'];
	
  public function run()
  {
      if (empty($this->links)) {
          //return;
      }
      $links = [];
      if ($this->homeLink === null) {
          $links[] = $this->renderItem([
              'label' => Yii::t('yii', 'Home'),
              'url' => Yii::$app->homeUrl,
          ], $this->itemTemplate);
      } elseif ($this->homeLink !== false) {
          $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
      }
      
      $links[] = $this->getModuleItem();
      
      foreach ($this->links as $link) {
          if (!is_array($link)) {
              $link = ['label' => $link];
          }
          $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
      }
      echo Html::tag($this->tag, implode('', $links), $this->options);
  }
  
  protected function getModuleItem()
  {
  	$controller = Yii::$app->controller;
  	$module = $controller->module;
  	$name = $module->getName();
  	$url = $module->defaultBackendRoute . '/' . $controller->defaultAction;
  	
  	
  	if (in_array($module->id, $this->hidenModules)) {
			return false;	
		}
		
		return	 $this->renderItem([
				'label' => $module->getName(),
				'url' => [$url],
		], $this->itemTemplate);
	}
}
