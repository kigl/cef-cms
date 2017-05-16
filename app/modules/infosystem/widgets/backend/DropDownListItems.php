<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 23.04.2017
 * Time: 18:28
 */

namespace app\modules\infosystem\widgets\backend;


use Yii;
use yii\caching\DbDependency;

class DropDownListItems extends \app\core\widgets\DropDownLIstItems
{
    protected function getAllItems()
    {
        $duration = 3600 * 24 * 12;
        $modelClassName = $this->getModelClassName();
        $dependency = new DbDependency([
            'sql' => "SELECT [[update_time]] FROM " . $this->getModelTableName() . ' ORDER BY [[update_time]] DESC LIMIT 1',
        ]);

        return Yii::$app->cache->getOrSet($this->getCacheKey(), function () use ($modelClassName) {
            return $modelClassName::find()
                ->where(['infosystem_id' => $this->model->infosystem_id])
                ->select($this->select)
                ->asArray()
                ->all();
        }, $duration, $dependency);
    }

    protected function getCacheKey()
    {
        return $this->model->infosystem_id . parent::getCacheKey();
    }
}