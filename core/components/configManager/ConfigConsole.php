<?php

namespace app\core\components\configManager;

class ConfigConsole extends \app\core\components\configManager\Config
{
    protected $_fileName = 'console';

    public function getSampleFileNameConfig()
    {
        return "{$this->_fileName}.php";
    }
}