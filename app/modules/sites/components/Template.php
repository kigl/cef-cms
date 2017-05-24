<?php
/**
 * Class Theme
 * @package app\modules\template\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\components;


use Yii;
use yii\base\ErrorException;

class Template extends \yii\base\Theme
{
    const DEFAULT_TEMPLATE = 'main';

    public $templatesPath = '@app/templates';
    public $templatesUrl = '@web/templates';

    protected $_currentTemplateSite;

    public function init()
    {
        parent::init();

        $siteComponent = Yii::$app->site;

        if (!$this->existTemplate($this->_currentTemplateSite)) {
            $this->_currentTemplateSite = self::DEFAULT_TEMPLATE;
        }

        $this->setBasePath($this->getTemplatePath($this->_currentTemplateSite, true));
        $this->setBaseUrl($this->getTemplatePath($this->_currentTemplateSite, true, true));

        $this->pathMap = [
            '@app/views' => $this->getTemplatePath($this->_currentTemplateSite, true) . '/views',
            '@app/modules' => $this->getTemplatePath($this->_currentTemplateSite, true) . '/modules',
        ];

        if ($layout = $siteComponent->getLayout()) {

            Yii::$app->layout = $this->getLayoutPath($this->_currentTemplateSite, $layout, true);
        }
    }

    public function getTemplatesPath($alias = false, $url = false)
    {
        $path = $url ? $this->templatesUrl : $this->templatesPath;

        return $alias ? $path : Yii::getAlias($path);
    }

    public function getTemplatePath($templateId, $alias = false, $url = false)
    {
        return $this->getTemplatesList($alias, $url)[$templateId];
    }

    public function getLayoutsPath($templateId, $alias = false, $url = false)
    {
        $separator = $alias ? '/' : DIRECTORY_SEPARATOR;

        return $this->getTemplatePath($templateId, $alias, $url) . $separator . 'layouts';
    }

    public function getTemplatesList($alias = false, $url = false)
    {
        $path = $this->getTemplatesPath();

        $result = [];

        if (is_dir($path)) {
            foreach (scandir($path) as $template) {
                $templatePath = $path . DIRECTORY_SEPARATOR . $template;

                if (is_dir($templatePath)) {

                    if ($alias) {
                        $templatePath = $this->getTemplatesPath($alias, $url) . '/' . $template;
                    }

                    $result[$template] = $templatePath;
                }
            }
        }

        // улучшить
        unset($result['.'], $result['..']);

        return $result;
    }

    public function getLayoutsList($templateId, $extension = true, $alias = false, $url = false)
    {
        $path = $this->getLayoutsPath($templateId);

        $result = [];

        if (is_dir($path)) {
            foreach (scandir($path) as $file) {
                $filePath = $path . DIRECTORY_SEPARATOR . $file;

                if (is_file($filePath) && (substr($file, -4, 4) == '.php')) {

                    $extensionFile = $extension ? $file : strstr($file, '.', true);

                    $result[$extensionFile] = $alias ? $this->getLayoutsPath($templateId, $alias,
                            $url) . '/' . $file : $filePath;
                }
            }
        }

        return $result;
    }

    public function getLayoutPath($templateId, $layout, $alias = false)
    {
        return $this->getLayoutsList($templateId, false, $alias)[$layout];
    }

    public function existTemplate($templateId)
    {
        return array_key_exists($templateId, $this->getTemplatesList());
    }
}
