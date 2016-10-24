<?php

namespace app\components\configManager;

class ConfigConsole extends \app\components\configManager\Config
{
    protected $_fileName = 'console';

    public function getSampleFileNameConfig()
    {
        return "{$this->_fileName}.php";
    }
}