<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 23.04.2017
 * Time: 18:28
 */

namespace app\modules\infosystem\widgets\backend;


use yii\caching\DbDependency;
use app\core\widgets\allGroups\DropDownLIst;

class DropDownListAllGroup extends DropDownLIst
{
    protected function getAllItems()
    {
        $dependency = new DbDependency([
            'sql' => "SELECT MAX(update_time) FROM" . $this->getModelTableName(),
        ]);

        if (!$data = \Yii::$app->cache->get($this->getCacheKey())) {
            $modelClassName = $this->getModelClassName();

            $data = $modelClassName::find()
                ->where(['infosystem_id' => $this->model->infosystem_id])
                ->select($this->select)
                ->asArray()
                ->all();

            \Yii::$app->cache->set($this->getCacheKey(), $data, 3600 * 24 * 12, $dependency);
        }

        return $data;
    }

    protected function getCacheKey()
    {
        return $this->model->infosystem_id . parent::getCacheKey();
    }
}