<?php

namespace app\modules\page;

/**
 * Page module definition class
 */
class Module extends \app\core\module\Module
{
    public function getDynamicPagePath()
    {
        return $this->getBasePath() . '/views/dynamicPage';
    }
}
