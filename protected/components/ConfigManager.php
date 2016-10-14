<?php

namespace app\components;

class ConfigManager
{
    /**
     * @var string
     */
    protected $_modulesPath = 'modules';

    /**
     * @var string
     */
    protected $_configDirName = 'config';

    /**
     * @var string
     */
    protected $_configModuleName = 'module';

    /**
     * @var
     */
    protected $_baseConfig;

    public function __construct($baseConfig)
    {
        $this->_baseConfig = $baseConfig;
    }

    /**
     * Сливает в один массив конфигурации модулей
     * @return [array] [конфигурации модулей]
     */
    public function getConfig()
    {
        $config = [];
        foreach ($this->getConfigModules() as $file) {
            $array = require $file;
            if (is_array($array)) {
                $config = array_merge_recursive($config, $array);
            }
        }

        return array_merge_recursive($config, $this->_baseConfig);
    }

    /**
     * @return array
     */
    protected function getConfigModules()
    {
        $configFile = $this->_configModuleName . '.php';

        $result = [];
        foreach ($this->getAllModulesPath() as $path) {
            $file = $path . DS . $configFile;

            if (is_file($file)) {
                $result[] = $file;
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getModulesPath()
    {
        return realpath(dirname(__DIR__) . DS . $this->_modulesPath);
    }

    /**
     * @return array
     */
    protected function getAllModulesPath()
    {
        $scanPathModule = scandir($this->getModulesPath());

        $modules = [];
        foreach ($scanPathModule as $name) {
            $path = $this->getModulesPath() . DS . $name . DS . $this->_configDirName;
            if (is_dir($path)) {
                $modules[] = $path;
            }
        }

        return $modules;
    }
}
