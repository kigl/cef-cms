<?php

namespace app\core\module;


use Yii;
use yii\helpers\ArrayHelper;

abstract class Module extends \yii\base\Module implements ModuleInterface
{
    public $defaultRoute = 'default';

    public $toolbar = [];

    public $registerTranslation = true;

    public function init()
    {
        if ($this->registerTranslation) {
            $this->registerTranslation();
        }

        parent::init();
    }

    public function getVersion()
    {
        return static::VERSION;
    }

    public function getName()
    {
        return Yii::t($this->id, 'Module name');
    }

    public function getDescription()
    {
        return Yii::t($this->id, 'Module description');
    }

    public static function t($message, $params = [])
    {
        return Yii::t(self::getInstance()->id, $message, $params);
    }

    /* не знаяю для чего сделал
    public function getAppPathUrl()
    {
        return Yii::$app->request->getHostInfo() . '/';
    }
    */

    public function getAlias()
    {
        $moduleNamespace = (new \ReflectionClass($this))->getNamespaceName();

        return '@' . str_replace('\\', '/', $moduleNamespace);
    }

    protected function registerTranslation()
    {
        $translations = [
            $this->id => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => $this->getAlias() . '/messages',
                'fileMap' => [
                    $this->id => 'module.php',
                ]
            ]
        ];

        $config['translations'] = ArrayHelper::merge(Yii::$app->i18n->translations, $translations);

        Yii::configure(Yii::$app->i18n, $config);
    }
}
