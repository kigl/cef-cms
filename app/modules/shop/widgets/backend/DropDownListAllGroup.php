<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 23.04.2017
 * Time: 18:28
 */

namespace app\modules\shop\widgets\backend;


use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\caching\DbDependency;
use app\modules\shop\models\Group;

class DropDownListAllGroup extends Widget
{
    public $model;

    public $attribute;

    public $options = [];

    protected $cacheKey = 'shopAllGroup';

    public function run()
    {
        $items = $this->getAllItems();
        $result = [];
        $this->generateListItems($items, $result);

        Html::addCssClass($this->options, 'form-control');

        echo Html::activeDropDownList(
            $this->model,
            $this->attribute,
            ArrayHelper::map($result, 'id', 'name'),
            ArrayHelper::merge([
                'encode' => false,
                'prompt' => [
                    'text' => Yii::t('app','Root'),
                    'value' => null,
                    'options' => [],
                ]
            ],
                $this->options
            )
        );

    }

    protected function generateListItems(&$data, &$result, $parentId = null, $level = 1)
    {
        foreach ($data as $item) {
            if ($item['parent_id'] == $parentId) {

                array_push(
                    $result,
                    ['id' => $item['id'], 'name' => str_repeat('&nbsp;', $level*3) . $item['name']]
                );

                $this->generateListItems($data, $result, $item['id'], $level + 1);
            }
        }
    }

    protected function getAllItems()
    {
        $dependency = new DbDependency([
            'sql' => "SELECT MAX(update_time) FROM" . Group::tableName(),
        ]);

        if (!$data = \Yii::$app->cache->get($this->cacheKey)) {
            $data = Group::find()
                ->select(['id', 'name', 'parent_id', 'alias'])
                ->asArray()
                ->all();

            \Yii::$app->cache->set($this->cacheKey, $data, 3600 * 24 * 12, $dependency);
        }

        return $data;
    }
}