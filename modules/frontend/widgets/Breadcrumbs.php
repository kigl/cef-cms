<?php
/**
 * Class Breadcrumbs
 * @package app\modules\frontend\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\frontend\widgets;

use Yii;
use yii\helpers\Html;

class Breadcrumbs extends \app\core\widgets\Breadcrumbs
{

    public function getHiddenModules()
    {
       return ['frontend'];
    }

    public function getDefaultRouteModule()
    {
        return Yii::$app->controller->module->defaultRoute;
    }

    public function getLinks()
    {
        return Yii::$app->view->getBreadcrumbs();
    }

    /*
    private function getHomeLink()
    {
        return [
            'label' => Yii::t('app', 'Link name page main'),
            'url' => $this->homeLinkUrl,
        ];
    }

    private function getLinks()
    {
        return Yii::$app->views->getBreadcrumbs();
    }

    private function getActiveItemTemplate()
    {
        return "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>";
    }
    */
}