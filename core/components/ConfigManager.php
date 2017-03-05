<?php

namespace app\core\components;


use Yii;
use yii\base\ErrorException;

/**
 * Class ConfigManager
 * Сливает конфигурации
 * @package app\components
 */
class ConfigManager extends  \yii\base\Component
{
    const CONFIG_TYPE_WEB= 'web';
    const CONFIG_TYPE_CONSOLE= 'console';
    const CONFIG_TYPE_OTHER = 'other';

    /**
     * @var string
     */
    protected $dirName = 'config';
    /**
     * @var string
     */
    public $modulesPath;

    public $type = '';

    protected $configData = null;

    public function init()
    {
        parent::init();

        if ($this->type === '') {
            throw new ErrorException('Config type is not defined', 500);
        }
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        if (is_null($this->configData)) {
            $this->configData = $this->mergeConfigs();
        }

        return $this->configData;
    }

    /**
     * @return array
     */
    protected function mergeConfigs()
    {
        $config = [];
        foreach ($this->getAllConfig() as $file) {
            $array = include $file;
            if (is_array($array)) {
                $config = array_merge_recursive($config, $array);
            }
        }

        return $config;
    }

    /**
     * @return array
     */
    protected function getAllConfig()
    {
        $configFile = $this->type . '.php';

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
        /**
         * @todo
         * Добавить проверку на наличие папки
         * Вывод ошибки
         */
        return Yii::getAlias($this->modulesPath);
    }

    /**
     * @return array
     */
    protected function getAllModulesPath()
    {
        $scanPathModule = array_diff(scandir($this->getModulesPath()), ['.', '..']);

        $modules = [];
        foreach ($scanPathModule as $name) {
            $path = $this->getModulesPath() . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . $this->dirName;
            if (is_dir($path)) {
                $modules[] = $path;
            }
        }

        return $modules;
    }
}
