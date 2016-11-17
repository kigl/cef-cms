<?php

namespace app\modules\admin\widgets;

use Yii;
use yii\helpers\Html;

class Breadcrumbs extends \app\core\widgets\Breadcrumbs
{
    public function getHiddenModules()
    {
        return ['admin'];
    }

    public function getDefaultRouteModule()
    {
        return Yii::$app->controller->module->defaultBackendRoute;
    }

    public function getLinks()
    {
        return Yii::$app->view->getBreadcrumbs();
    }
}
