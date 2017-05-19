<?php
/**
 * Class Site
 * @package app\modules\site\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\site\components;


use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\ErrorException;
use app\modules\site\models\Site as SiteModel;

class Site extends Component implements BootstrapInterface
{
    protected $_id;

    protected $_templateId;

    public function bootstrap($app)
    {
        $domain = Yii::$app->request->hostName;

        if ($model = $this->getSiteModel($domain)) {

            $this->_id = $model->id;
            $this->_templateId = $model->template_id;

        } /*else {
            throw new ErrorException('No site with domain: '. $domain .' or inactive', 500);
        }*/
    }

    protected function getSiteModel($domain)
    {
        return SiteModel::find()
            ->select(['id', 'template_id'])
            ->where(['domain' => $domain, 'active' => SiteModel::ACTIVE])
            ->one();
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getTemplateId()
    {
        return $this->_templateId;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }
}