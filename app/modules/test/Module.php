<?php
/**
 * Class Module
 * @package app\modules\test
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\test;


class Module extends \kigl\cef\core\module\Module
{
    const VERSION = '1.0.0.0';

    public function getName()
    {
        return 'test';
    }

    public function getDescription()
    {
        return 'test';
    }
}