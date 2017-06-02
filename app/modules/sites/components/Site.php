<?php
/**
 * Class Site
 * @package app\modules\site\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\components;


use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use app\modules\sites\models\Site as SiteModel;

class Site extends Component implements BootstrapInterface
{
    protected $_id;

    protected $_templateId;

    protected $_layout;

    protected $_uploadDir;

    public function bootstrap($app)
    {
        $domain = Yii::$app->request->hostName;

        if ($model = $this->getSiteModel($domain)) {

            $this->_id = $model->id;
            $this->_templateId = $model->template_id;
            $this->_layout = $model->layout;
            $this->_uploadDir = $model->upload_dir;
        }
    }

    protected function getSiteModel($domain)
    {
        return SiteModel::find()
            ->where(['domain' => $domain,])
            ->one();
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getTemplateId()
    {
        return isset($this->_templateId) ? $this->_templateId : null;
    }

    public function getLayout()
    {
        return isset($this->_layout) ? $this->_layout : null;
    }

    public function getUploadPath($alias = false)
    {
        $path = '@webroot/' . $this->_uploadDir;
        return $alias ? $path : Yii::getAlias($path);
    }

    public function getUploadPathUrl($alias = false)
    {
        $path = '@web/' . $this->_uploadDir;
        return $alias ? $path : Yii::getAlias($path);
    }
}