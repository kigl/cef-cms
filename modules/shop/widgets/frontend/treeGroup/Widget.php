<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\treeGroup;

use Yii;
use app\modules\shop\models\Group;
use app\modules\shop\widgets\frontend\treeGroup\asset\Asset;

class Widget extends \yii\base\Widget
{
    public $options;

    public function run()
    {
        Asset::register($this->view);

        return $this->render('index', [
            'data' => $this->getDataTreeGroup(),
            'options' => $this->options,
            ]);
    }

    private function getModelsGroup()
    {
        return Group::find()->asArray()->all();
    }

    private function toRenewData($data)
    {
        $dt = [];
        foreach ($data as $item) {
            $dt[$item['parent_id']][$item['id']] = $item;
        }

        return $dt;
    }

    public function getDataTreeGroup($parentId = 0)
    {
        $dataForMenu = $this->toRenewData($this->getModelsGroup());

        return $this->createDataTreeGroup($dataForMenu, $parentId);
    }

    private function createDataTreeGroup($data, $parentId)
    {
        if (empty($data[$parentId])) {
            return;
        }

        $result = [];
        foreach ($data[$parentId] as $item) {
            $result[$item['id']] = [
                'label' => $item['name'],
                'url' => ['/shop/group/view', 'id' => $this->isAlias()? $item['alias'] : $item['id']],
                'items' => $this->createDataTreeGroup($data, $item['id']),
            ];
        }
        return $result;
    }

    protected function isAlias()
    {
        return Yii::$app->getModule('shop')->urlAlias;
    }
}