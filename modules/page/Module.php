<?php

namespace app\modules\page;

/**
 * Page module definition class
 */
class Module extends \app\core\module\Module
{
    public function getViewFilesPathUrl()
    {
        return $this->getBasePath() . '/views/files';
    }
}
