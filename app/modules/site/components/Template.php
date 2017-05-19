<?php
/**
 * Class Theme
 * @package app\modules\template\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\site\components;


use Yii;

class Template extends \yii\base\Theme
{
    public $templatePath = '@app/templates';
    public $templateUrl = '@web/templates';

    protected $_currentTemplateSite;

    public function init()
    {
        parent::init();

        // задаем текущий шаблон
        $this->_currentTemplateSite = Yii::$app->site->getTemplateId();

        $this->setBasePath(Yii::getAlias($this->templatePath) . DIRECTORY_SEPARATOR . $this->_currentTemplateSite);
        $this->setBaseUrl(Yii::getAlias($this->templateUrl) . '/' . $this->_currentTemplateSite);
        $this->pathMap = [
            '@app/views' => $this->getBasePath() . DIRECTORY_SEPARATOR . 'views',
            '@app/modules' => $this->getBasePath() . DIRECTORY_SEPARATOR . 'modules',
        ];
    }
}