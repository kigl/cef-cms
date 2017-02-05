<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 05.02.2017
 * Time: 16:34
 */

namespace app\modules\service\widgets\frontend\menu;


use app\modules\service\models\MenuItem;

class Widget extends \yii\base\Widget
{
    public $menuId;

    public function run()
    {
        $data = $this->getModelsItem();

        echo "<pre>";
        var_dump(\Yii::$app->urlManager->rules); exit;

        return $this->render('index', ['data' => $this->createDataMenu($data)]);
    }

    protected function getModelsItem()
    {
        return MenuItem::find()
            ->where(['menu_id' => $this->menuId])
            ->asArray()
            ->all();
    }

    private function createDataMenu(&$data = [], $parentId = null)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] === $parentId) {
                $result[$item['id']] = [
                    'label' => $item['name'],
                    'url' => $this->parseUrl($item['url']),
                    //'active' => $this->groupId && $item['id'] == $this->groupId ? true : null,
                    'items' => $this->createDataMenu($data, $item['id']),
                ];
            }
        }
        return $result;
    }

    protected function parseUrl($url)
    {
        

        $data = explode(',', $url);

        return strlen($data[0]) > 0 ? $data : null;
    }
}