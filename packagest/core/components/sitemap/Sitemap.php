<?php
/**
 * Class Sitemap
 * @package app\modules\sitemap\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\core\components\sitemap;


use Yii;
use yii\base\Component;

class Sitemap extends Component
{
    public $models = [];

    public function getUrls()
    {
        $url = [];
        foreach ($this->models as $models) {
            $models = Yii::createObject($models)
                ->getModelItems();

            foreach ($models as $model) {
                $url[] = $model->getModelItemUrl();
            }
        }

        return $url;
    }

    public function getHost()
    {
        return Yii::$app->request->hostInfo;
    }
}