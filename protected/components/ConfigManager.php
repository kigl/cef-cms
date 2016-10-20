<?php

namespace app\components;

/**
 * Class ConfigManager
 * @package app\components
 */
class ConfigManager
{
    const CONFIG_TYPE_WEB = 'web';
    const CONFIG_TYPE_CONSOLE = 'console';
    /**
     * @var string
     */
    protected $_modulesPath = 'modules';
    /**
     * @var string
     */
    protected $_dirName = 'config';
    /**
     * @var array
     */
    protected $_baseConfig;

    public function __construct($baseConfig)
    {
        $this->_baseConfig = $baseConfig;
    }

    public function getConfig($type)
    {
        return $this->mergeConfigs($type);
    }

    /**
     * @param $type
     * @return array
     */
    protected function mergeConfigs($type)
    {
        $config = [];
        foreach ($this->getAllConfig($type) as $file) {
            $array = require $file;
            if (is_array($array)) {
                $config = array_merge_recursive($config, $array);
            }
        }

        return array_merge_recursive($config, $this->_baseConfig);
    }

    /**
     * @param $type
     * @return array
     */
    protected function getAllConfig($type)
    {
        $configFile = $this->getFileName($type);

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
     * @TODO
     */
    protected function getFileName($type)
    {
        switch ($type) {
            case self::CONFIG_TYPE_WEB :
                return 'module.php';
                break;
            case self::CONFIG_TYPE_CONSOLE :
                return 'console.php';
                break;
        }
    }

    /**
     * @return string
     */
    protected function getModulesPath()
    {
        return realpath(dirname(__DIR__) . DIRECTORY_SEPARATOR . $this->_modulesPath);
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
