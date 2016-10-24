<?php

namespace app\components\configManager;

class ConfigWeb extends \app\components\configManager\Config
{
    protected $_fileName = 'module';

    public function getSampleFileNameConfig()
    {
        return "{$this->_fileName}.php";
    }
}