<?php

namespace app\core\traits;


use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

trait Breadcrumbs
{
    /**
     * $breadcrumbs = $this->buildBreadcrumb([
     * 'items' => [
     *      'id' => 12,
     *      'modelClass' => 'ModelClass',
     *      'enableRoot' => true,
     *      'urlOptions' => [
     *          'route' => 'controller/action',
     *          'params' => [param_id, 'par_id'],
     *          'queryParams' => [
     *              'query' => 'views',
     *              ],
     *          ],
     *      ],
     * ]);
     */

    public function buildBreadcrumbs(array $params)
    {
        $groupItem = [];

        if (array_key_exists('items', $params)) {
            $groupItem = $this->getLinkItems($params['items']);
        }

        return $groupItem;
    }

    protected function getLinkItems($params = [])
    {
        $data = $this->getDbData($params['modelClass']);
        $breadcrumbs = $this->groupsDataRecursive($params['id'], $data);

        krsort($breadcrumbs);

        $result = [];
        foreach ($breadcrumbs as $key => $model) {
            $result[$key] = [
                'label' => $model['name'],
                'url' => $this->getUrl($model, $params['urlOptions']['route'], $params['urlOptions']['params']),
            ];

            if (isset($params['urlOptions']['queryParams'])) {
                $result[$key]['url'] = ArrayHelper::merge(
                    $result[$key]['url'],
                    $params['urlOptions']['queryParams']);
            }
        }


        if (!empty($params['enableRoot']) && $params['enableRoot'] === true) {
            $root = [
                'label' => Yii::t('app', 'Breadcrumb root'),
                'url' => [
                    $params['urlOptions']['route'],
                    'parent_id' => null,
                ],
            ];

            if (isset($params['urlOptions']['queryParams'])) {
                $root['url'] = ArrayHelper::merge(
                    $root['url'],
                    $params['urlOptions']['queryParams']);
            }

            array_unshift($result, $root);
        }

        return $result ? $result : [];
    }

    protected function getUrl($model, $route, $params = [])
    {
        $result = [];

        foreach ($params as $param) {
            $result[$param] = $model[$param];
        }

        array_unshift($result, $route);

        return $result;
    }

    protected function groupsDataRecursive($id, &$data)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['id'] == $id) {

                $result[] = $item;

                $result = ArrayHelper::merge($result, $this->groupsDataRecursive($item['parent_id'], $data));
            }
        }

        return $result;
    }

    protected function getDbData($modelClass)
    {
        $cacheKey = $modelClass;
        $duration = 3600 * 24 * 12;
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX([[update_time]]) FROM ' . $modelClass::tableName(),
        ]);

        return Yii::$app->cache->getOrSet($cacheKey, function () use ($modelClass){
            return $modelClass::find()
                ->asArray()
                ->all();
        }, $duration, $dependency);
    }
}