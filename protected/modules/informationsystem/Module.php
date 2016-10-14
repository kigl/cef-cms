<?php

namespace app\modules\informationsystem;

use Yii;

/**
 * informationsystem module definition class
 */
class Module extends \app\components\Module
{
	public $defaultBackendRoute = 'manager';
	
	public $itemsPerPage = 10;
}
