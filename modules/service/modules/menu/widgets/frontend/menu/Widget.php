<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 05.02.2017
 * Time: 16:34
 */

namespace app\modules\service\modules\menu\widgets\frontend\menu;


use Yii;
use app\modules\service\modules\menu\models\Item;
use yii\helpers\ArrayHelper;

class Widget extends \yii\base\Widget
{
    public $menuId;

    public $options = [];

    public function run()
    {
        $data = $this->getModelsItem();

        return $this->render('index', [
            'data' => $this->createDataMenu($data),
            'options' => $this->options,
            ]);
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
        if (substr($url, '0', '7') === 'http://') {
            return $url;
        }

        $url = ltrim($url, '/');

        $data = explode(',', '/' . $url);

        return strlen($data[0]) > 0 ? $data : null;

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