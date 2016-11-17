<?php
/**
 * Class Breadcrumbs
 * @package app\core\widgets\Breadcrumbs
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets;

use Yii;
use yii\helpers\Html;

abstract class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    /**
     * @return array
     */
    abstract public function getHiddenModules();

    /**
     * @return string
     */
    abstract public function getDefaultRouteModule();

    abstract public function getLinks();

    public function run()
    {
        $this->links = $this->getLinks();

        if (empty($this->links)) {
            //return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('app', 'Link name page main'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }

        $links[] = $this->getModuleItem();

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }

    protected function getModuleItem()
    {
        $controller = Yii::$app->controller;
        $module = $controller->module;
        $url = $this->getDefaultRouteModule();


        if (in_array($module->id, $this->getHiddenModules())) {
            return false;
        }

        return	 $this->renderItem([
            'label' => $module->getName(),
            'url' => [$url],
        ], $this->itemTemplate);
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
        return Yii::$app->view->getBreadcrumbs();
    }

    private function getActiveItemTemplate()
    {
        return "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>";
    }
    */
}
