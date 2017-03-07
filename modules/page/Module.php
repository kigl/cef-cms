<?php

namespace app\modules\page;

/**
 * Page module definition class
 */
class Module extends \app\modules\backend\Module
{
    public function getDynamicPagePath()
    {
        return $this->getBasePath() . '/views/dynamicPage';
    }
}
