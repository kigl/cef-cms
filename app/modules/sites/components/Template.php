<?php
/**
 * Class Theme
 * @package app\modules\template\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\components;


use Yii;

class Template extends \yii\base\Theme
{
    public $templatesPath = '@app/templates';
    public $templatesUrl = '@web/templates';

    protected $_currentTemplateSite;

    public function init()
    {
        parent::init();

        // задаем текущий шаблон
        $this->_currentTemplateSite = Yii::$app->site->getTemplateId();

        $this->setBasePath($this->getBasePathAlias());
        $this->setBaseUrl($this->getBaseUrlAlias());

        $this->pathMap = [
            '@app/views' => $this->getBasePathAlias() . '/views',
            '@app/modules' => $this->getBasePathAlias() . '/modules',
        ];

        // убрать
        Yii::$app->layout = $this->getLayoutsPathAlias() . '/main.php';
    }

    public function getBasePathAlias()
    {
        return $this->templatesPath . '/' . $this->_currentTemplateSite;
    }

    public function getBaseUrlAlias()
    {
        return $this->templatesUrl . '/' . $this->_currentTemplateSite;
    }

    public function getLayoutsPathAlias()
    {
        return $this->getBasePathAlias() . '/' . 'layouts';
    }

    public function getLayoutsPath()
    {
        return Yii::getAlias($this->getLayoutsPathAlias());
    }
}
