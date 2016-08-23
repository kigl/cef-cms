<?php
/**
 * Менеджер слития базовых и пользовательских конфигураций
 */

class ConfigManager
{
	/**
	 * Путь к папки конфигураций
	 * @var string
	 */
	private $configDir = 'protected/config';

	private $config;

	public function __construct($baseConfig)
	{
		$this->config = array_merge_recursive($baseConfig, $this->getCongigModules());

	} 

	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Возвращает абсолютный путь папки конфигураций
	 * @return [type] [description]
	 */
	protected function getConfigDir()
	{
		$dir = trim($this->configDir);
		$path = ROOT_DIR . DS . $dir;

		return $path;
	}

	/**
	 * Получение массива файлов конфигураций модулей
	 * @return [array] [файлы конфигураций модулей]
	 */
	protected function scanDirModules()
	{
		$dir = $this->getConfigDir() . DS . 'modules';

		$allFiles = scandir($dir);
		unset($allFiles[0], $allFiles[1]);

		$result = [];
		foreach ($allFiles as $file) {
			$result[] = $dir . DS . $file;
		}

		return $result;
	}

	/**
	 * Возвращает конфигурации модулей
	 * @return [array] [конфигурации модулей]
	 */
	protected function getCongigModules()
	{
		return $this->mergeCongigModules();
	}

	/**
	 * Сливает в один массив конфигурации модулей
	 * @return [array] [конфигурации модулей]
	 */
	protected function mergeCongigModules()
	{
		$config = [];
		foreach ($this->scanDirModules() as $file) {
			$array = require $file;
			if (is_array($array)) {
				$config = array_merge_recursive($config, $array);
			}
		}

		return $config;
	}
}
