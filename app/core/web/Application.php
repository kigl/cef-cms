<?php
/**
 * Class Application
 * @package kigl\cef\core\web
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\web;


use Yii;
use yii\base\InvalidConfigException;

class Application extends \yii\web\Application
{
    protected $_tempPath;

    public function preInit(&$config)
    {
        parent::preInit($config);

        if (isset($config['tempPath'])) {
            $this->setTempPath($config['tempPath']);
        } else {
            throw new InvalidConfigException('The "tempPath" configuration for the Application is required.');
        }
    }

    /**
     * @return mixed
     */
    public function getTempPath()
    {
        return $this->_tempPath;
    }

    /**
     * @param mixed $tempPath
     */
    public function setTempPath($path)
    {
        $this->_tempPath = Yii::getAlias($path);
    }
}
