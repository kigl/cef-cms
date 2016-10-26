<?php

namespace app\modules\informationsystem;

/**
 * informationsystem module definition class
 */
class Module extends \app\components\Module
{
	public $defaultBackendRoute = 'manager/system';
	
	public $itemsPerPage = 10;
}
