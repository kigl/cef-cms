<?php
/**
 * Class Breadcrumbs
 * @package app\core\widgets\Breadcrumbs
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets;

use Yii;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $enableModuleItem = true;

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

        $items[] = $this->enableModuleItem ? $this->getModuleItem() : null;

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $items[] = ['label' => $link];
            }
            $items[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $items), $this->options);
    }

    protected function getModuleItem()
    {
        $module = Yii::$app->controller->module;

        return $this->renderItem([
            'label' => $module->getName(),
            'url' => [$module->defaultRoute],
        ], $this->itemTemplate);
    }
}
