<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\treeGroup;

use app\modules\shop\models\Group;
use yii\caching\DbDependency;
use yii\widgets\Menu;

class Widget extends \yii\base\Widget
{
    public $options;

    public $groupId;

    public function run()
    {
        $data = $this->getModelsGroup();

        echo Menu::widget([
            'items' => $this->createDataTreeGroup($data, null),
            'activateParents' => true,
            'options' => $this->options,
        ]);

    }

    private function getModelsGroup()
    {
        $dependency = new DbDependency([
            'sql' => "SELECT MAX(update_time) FROM" . Group::tableName(),
        ]);

        if (!$data = \Yii::$app->cache->get('treeGroup')) {
            $data = Group::find()
                ->select(['id', 'name', 'parent_id', 'alias'])
                ->asArray()
                ->all();
            
            \Yii::$app->cache->set('treeGroup', $data, 3600 * 24 * 12, $dependency);
        }

        return $data;
    }

    private function createDataTreeGroup(&$data = [], $parentId)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parentId) {
                $result[$item['id']] = [
                    'label' => $item['name'],
                    'url' => ['/shop/group/view', 'id' => $item['id'], 'alias' => $item['alias']],
                    'active' => $this->groupId && $item['id'] == $this->groupId ? true : null,
                    'items' => $this->createDataTreeGroup($data, $item['id']),
                ];
            }
        }
        return $result;
    }
}