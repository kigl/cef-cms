<?php
/**
 * Class BaseAllGroup
 * @package app\core\widgtes\allGroups
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets\allGroups;


use Yii;
use yii\db\ActiveRecord;
use yii\base\UnknownClassException;
use yii\base\Widget;
use yii\caching\DbDependency;

abstract class BaseAllGroup extends Widget
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
        return $this->model->tableName();
    }
}