<?php
/**
 * Class DropDownLIst
 * @package app\core\widgtes\allGroups
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\base\UnknownClassException;
use yii\base\Widget;
use yii\caching\DbDependency;

class DropDownLIstItems extends Widget
{
    public $model;

    public $attribute;

    public $modelClass = null;

    public $select = ['id', 'parent_id', 'name'];

    public $options = [];

    protected $_cacheKey = null;

    public function init()
    {
        if (!$this->model instanceof ActiveRecord) {
            throw new UnknownClassException();
        }

        parent::init();
    }

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
                    ['id' => $item['id'], 'name' => str_repeat('&nbsp;', $level * 3) . $item['name']]
                );

                $this->generateListItems($data, $result, $item['id'], $level + 1);
            }
        }
    }

    protected function getAllItems()
    {
        $modelClassName = $this->getModelClassName();
        $duration = 3600 * 24 * 12;
        $dependency = new DbDependency([
            'sql' => "SELECT MAX(update_time) FROM" . $this->getModelTableName(),
        ]);

        return Yii::$app->cache->getOrSet($this->getCacheKey(), function () use ($modelClassName) {
            return $modelClassName::find()
                ->select($this->select)
                ->asArray()
                ->all();
        }, $duration, $dependency);
    }

    protected function getCacheKey()
    {
        if (is_null($this->_cacheKey)) {

            $this->_cacheKey = $this->getModelClassName();
        }

        return $this->_cacheKey;
    }

    protected function getModelClassName()
    {
        return $this->modelClass ? $this->modelClass : $this->model->className();
    }

    protected function getModelTableName()
    {
        $modelClass = $this->getModelClassName();

        return $modelClass::tableName();
    }
}