<?php

namespace app\modules\informationsystem;

use Yii;

/**
 * informationsystem module definition class
 */
class Module extends \app\modules\main\components\Module
{
	public $defaultBackendRoute = 'backend/manager';
	
	public $itemsPerPage = 10;
}
