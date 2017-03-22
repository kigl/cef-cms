<?php
/**
 * Class Breadcrumbs
 * @package kigl\cef\module\backend\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\backend\widgets;


use Yii;

class Breadcrumbs extends \kigl\cef\core\widgets\Breadcrumbs
{
    protected function getModuleItem()
    {
        $module = Yii::$app->controller->module;

        return $this->renderItem([
            'label' => Yii::t('app', 'Module'),
            'url' => ['/backend/' . $module->id],
        ], $this->itemTemplate);
    }
}