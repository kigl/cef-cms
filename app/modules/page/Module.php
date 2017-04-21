<?php

namespace app\modules\page;


use Yii;
use yii\base\ErrorException;

/**
 * Page module definition class
 */
class Module extends \app\core\module\Module
{
    const VERSION = '1.0.0.01';

    protected $_dynamicDataPath = null;

    public function getDynamicDataPath()
    {
        if (is_null($this->_dynamicDataPath)) {
            throw new ErrorException(self::t('Please set dynamicDataPath in module config'));
        }

        return $this->_dynamicDataPath;
    }

    public function setDynamicDataPath($path)
    {
        $this->_dynamicDataPath = Yii::getAlias($path);
    }
}
