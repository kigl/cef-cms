<?php

namespace app\modules\informationsystem;

use yii\jui\DatePicker;

/**
 * informationsystem module definition class
 */
class Module extends \app\core\module\Module
{
	public $defaultBackendRoute = 'manager/system';

	public function init()
    {
        \Yii::$container->set(DatePicker::class, [
            'dateFormat' => 'dd/MM/yyyy',
        ]);

        parent::init();
    }
}
