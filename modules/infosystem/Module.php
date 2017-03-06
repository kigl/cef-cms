<?php

namespace app\modules\infosystem;

use yii\jui\DatePicker;

/**
 * infosystem module definition class
 */
class Module extends \app\core\module\Module
{
	public $defaultBackendRoute = 'infosystem/manager';

	public function init()
    {
        \Yii::$container->set(DatePicker::class, [
            'dateFormat' => 'dd-MM-yyyy',
        ]);

        parent::init();
    }
}
