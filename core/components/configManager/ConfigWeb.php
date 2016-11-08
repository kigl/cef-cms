<?php

namespace app\core\components\configManager;

class ConfigWeb extends \app\core\components\configManager\Config
{
    protected $_fileName = 'module';

    public function getSampleFileNameConfig()
    {
        return "{$this->_fileName}.php";
    }
}