<?php
/**
 * Class Breadcrumbs
 * @package app\modules\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\backend;


use Yii;

class Breadcrumbs extends \app\core\widgets\Breadcrumbs
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