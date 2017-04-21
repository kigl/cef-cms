<?php
/**
 * Class Breadcrumbs
 * @package app\core\widgets\Breadcrumbs
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets;


use Yii;
use yii\base\Module;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $enableModule = true;

    public function run()
    {
        $items = [];

        if ($this->homeLink === null) {
            $items[] = $this->renderItem([
                'label' => Yii::t('app', 'Link name page main'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $items[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }

        if ($this->enableModule) {

            foreach ($this->getModuleItem($this->getTreeModules()) as $module) {
                $items[] = $module;
            }
        }

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $items[] = ['label' => $link];
            }
            $items[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $items), $this->options);
    }

    protected function getModuleItem($modules)
    {
        $result = [];
        $items = [];

        foreach ($modules as $id => $module) {
            $items[] = $module->id;

            $result[] = $this->renderItem([
                'label' => $module->getName(),
                'url' => [$this->getRouteModule($items)],
            ], $this->itemTemplate);
        }

        return $result;
    }

    protected function getTreeModules()
    {
        $modules = [];
        $this->generateTreeModules(Yii::$app->controller->module, $modules);

        // Удалим из массива модуль приложения
        unset($modules[Yii::$app->id]);

        return array_reverse($modules);
    }

    /**
     * Строит массив вложенных модулей и текущего модуля
     * @param $module
     * @param $modules Массив модулей
     */
    protected function generateTreeModules($module, &$modules)
    {
        if ($module instanceof Module) {
            $modules[$module->id] = $module;

            $this->generateTreeModules($module->module, $modules);
        }
    }

    /**
     * Формироует путь модулей
     * @param array $modules
     * @return string
     */
    protected function getRouteModule(array $modules)
    {
        $result = array_map(function ($value) {
            return '/' . $value;
        }, $modules);

        return implode('', $result);
    }
}
