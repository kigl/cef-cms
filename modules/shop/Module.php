<?php

namespace app\modules\shop;

/**
 * shop module definition class
 */
class Module extends \app\core\module\Module
{
    /**
     * использование псевдонима элемента в url
     * @var bool
     */
    public $urlAlias = false;

    public $defaultBackendRoute = 'group/manager';
}
