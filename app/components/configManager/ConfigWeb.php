<?php

namespace app\components\configManager;

class ConfigWeb extends \app\components\configManager\Config
{
    protected $_fileName = 'module';

    public function getFileName()
    {
        return $this->_fileName;
    }
}