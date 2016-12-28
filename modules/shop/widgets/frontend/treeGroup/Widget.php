<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\treeGroup;

use app\modules\shop\models\Group;

class Widget extends \yii\base\Widget
{
    public $options;
    
    public $groupId;

    public function run()
    {
        $data = $this->getModelsGroup();

        return $this->render('index', [
            'data' => $this->createDataTreeGroup($data, 0),
            'options' => $this->options,
            ]);
    }

    private function getModelsGroup()
    {
        return Group::find()->select(['id', 'name', 'parent_id', 'alias'])->asArray()->all();
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