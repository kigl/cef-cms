<?php

namespace kigl\cef\module\page;


use Yii;
/**
 * Page module definition class
 */
class Module extends \kigl\cef\core\module\Module
{
    public function getDynamicPagePath()
    {
        return $this->getBasePath() . '/views/dynamicPage';
    }
}
