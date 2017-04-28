<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 05.02.2017
 * Time: 16:34
 */

namespace app\modules\menu\widgets;


use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\Menu as YiiMenu;
use app\modules\menu\models\Menu as MenuModel;
use app\modules\menu\models\Item;

class Menu extends \yii\base\Widget
{
    public $menuId;

    public $options = [];

    public function run()
    {
        $data = $this->getModelsItem();

        if ($dataMenu = $this->createDataMenu($data)) {

            echo YiiMenu::widget([
                'options' => ArrayHelper::merge($this->options, ['class' => $this->getModelMenu()->class]),
                'activateParents' => true,
                'items' => $dataMenu,
                'encodeLabels' => false,
            ]);
        }
    }

    protected function getModelMenu()
    {
        return MenuModel::findOne($this->menuId);
    }

    protected function getModelsItem()
    {
        $data = Item::find()
            ->where(['menu_id' => $this->menuId])
            ->asArray()
            ->indexBy('id')
            ->all();

        ArrayHelper::multisort($data, ['sorting'], [SORT_ASC]);

        return $data;
    }

    private function createDataMenu(&$data = [], $parentId = null)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] === $parentId) {
                $result[$item['id']] = $menu = [
                    'label' => $this->getLabel($item['name'], $item['item_icon_class']),
                    'url' => $this->parseUrl($item['url']),
                    'visible' => $this->isVisible($item['visible']),
                    'items' => $this->createDataMenu($data, $item['id']),
                ];
            }
        }

        return $result;
    }

    protected function getLabel($label, $iconClass)
    {
        if ($iconClass !== '') {
            return "<i class='". $iconClass ."'></i>&nbsp" . $label;
        }

        return $label;
    }

    protected function parseUrl($url)
    {
        if (!$url) {
            return null;
        }

        if (substr($url, '0', '1') === '#') {
            return $url;
        }

        if (substr($url, '0', '7') === 'http://') {
            return $url;
        }

        $url = parse_url($url);
        $result = [];

        if (!empty($url['query'])) {
            parse_str($url['query'], $result);
        }

        if (!empty($url['fragment'])) {
            $result['#'] = $url['fragment'];
        }

        array_unshift($result, $url['path']);

        return $result;
    }

    protected function isVisible($visible)
    {
        switch ($visible) {
            case Item::STATUS_VISIBLE_GUEST :
                return Yii::$app->user->IsGuest;
                break;
            case Item::STATUS_VISIBLE_NOT_GUEST :
                return !Yii::$app->user->isGuest;
                break;
            default :
                return true;
        }
    }
}