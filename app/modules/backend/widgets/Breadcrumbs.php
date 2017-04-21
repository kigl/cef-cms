<?php
/**
 * Class Breadcrumbs
 * @package kigl\cef\module\backend\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\backend\widgets;


use Yii;

class Breadcrumbs extends \app\core\widgets\Breadcrumbs
{
    protected function getModuleItem($modules)
    {
        $result = [];
        $items = [];

        foreach ($modules as $id => $module) {
            $items[] = $module->id;

            $result[] = $this->renderItem([
                'label' => $module->getName(),
                'url' => [$this->getRouteModule($items) . '/' . 'backend-default'],
            ], $this->itemTemplate);
        }

        return $result;
    }
}