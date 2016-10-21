<?php

namespace app\components\configManager;

/**
 * Class ConfigManager
 * @package app\components
 */
class ConfigManager
{
    /**
     * @var string
     */
    protected $_dirName = 'config';
    /**
     * @var array
     */
    protected $_baseConfig;
    /**
     * @var Config
     */
    protected $_config;
    /**
     * @var string
     */
    public $modulesPath;

    /**
     * ConfigManager constructor.
     * @param array $baseConfig
     * @param Config $config
     */
    public function __construct(array $baseConfig, Config $config)
    {
        $this->_baseConfig = $baseConfig;
        $this->_config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->mergeConfigs();
    }

    /**
     * @return array
     */
    protected function mergeConfigs()
    {
        $config = [];
        foreach ($this->getAllConfig() as $file) {
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
    protected function getAllConfig()
    {
        $configFile = $this->_config->getFileName() . '.php';

        $result = [];
        foreach ($this->getAllModulesPath() as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $configFile;
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
        return $this->modulesPath;
    }

    /**
     * @return array
     */
    protected function getAllModulesPath()
    {
        $unsetInScanPathModule = ['.', '..'];

        $scanPathModule = scandir($this->getModulesPath());
        $scanPathModule = $this->unsetInArray($scanPathModule, $unsetInScanPathModule);

        $modules = [];
        foreach ($scanPathModule as $name) {
            $path = $this->getModulesPath() . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $this->_dirName;
            if (is_dir($path)) {
                $modules[] = $path;
            }
        }

        return $modules;
    }

    /**
     * @param $haystack
     * @param array $unset
     * @return array
     */
    protected function unsetInArray($haystack, array $unset)
    {
        $result = [];

        foreach ($haystack as $value) {
            if (!in_array($value, $unset)) {
                $result[] = $value;
            }
        }

        return $result;
    }
}
