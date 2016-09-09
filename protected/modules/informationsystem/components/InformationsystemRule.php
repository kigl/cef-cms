<?php

namespace app\modules\informationsystem\components;

use yii\web\UrlRuleInterface;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class InformationsystemRule implements UrlRuleInterface
{
	public $systemControllerAction = 'informationsystem/system/test';
	public $itemsControllerAction = 'informationsystem/items/group';
	
	public function createUrl($manager, $route, $params)
	{
		return false;
	}
	
	public function parseRequest($manager, $request)
	{
		$pathInfo = $request->getPathInfo();
		$request = explode('/', $pathInfo);
		
		if (isset($request[0])) {
			if ($modelSystem = System::getSystem($request[0], 'array')) {
				return [$this->systemControllerAction, ['id' => $modelSystem['id']]];
			}
		}
		
		if ((isset($request[1])) and ($modelSystem)) {
			if ($modelItems = Item::getItems($request[1], 'array')) {
				return [$this->itemsControllerAction, ['group_id']];
			}
		}
		
		return false;
	}
}