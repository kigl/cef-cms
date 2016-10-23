<?php

namespace app\components\configManager;

class ConfigConsole extends \app\components\configManager\Config
{
    protected $_fileName = 'console';

    public function getFileName()
    {
       return $this->_fileName;
    }
}