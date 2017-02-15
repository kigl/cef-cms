<?php

namespace app\core\traits;

use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

trait Breadcrumbs
{
    /**
     * $breadcrumbs = $this->buildBreadcrumb([
     * 'group' => [
     *      'id' => 12,
     *      'modelClass' => 'ModelClass',
     *      'enableRoot' => true,
     *           'urlOptions' => [
     *           'route' => 'controller/action',
     *           'params' => [param_id, 'par_id'],
     *           'queryParams' => [
     *              'query' => 'views',
     *              ],
     *          ],
     *      ],
     * 'group' => [
     *      'id' => 12,
     *      'modelClass' => 'ModelClass',
     *      'enableRoot' => true,
     *           'urlOptions' => [
     *           'route' => 'controller/action',
     *           'params' => [param_id, 'par_id'],
     *           'queryParams' => [
     *              'query' => 'views',
     *              ],
     *          ],
     *      ],
     * 'items' => [
     *      ['label' => 'name'],
     *      ],
     * ]);
     */

    public function buildBreadcrumb(array $params)
    {
        $groupItem = [];
        $items = [];

        if (array_key_exists('group', $params)) {
            $groupItem = $this->getLinksGroup($params['group']);
        }

        if (array_key_exists('items', $params)) {
            $items = $params['items'];
        }

        return ArrayHelper::merge($groupItem, $items);
    }

    protected function getLinksGroup($params = [])
    {
        $data = $this->getDbData($params['modelClass']);
        $breadcrumbs = $this->groupsDataRecursive($params['id'], $data);
        sort($breadcrumbs);

        /*$root = [
            'label' => Yii::t('app', 'Breadcrumbs root'),
            'url' => [
                $params['urlOptions']['route'],
                //$config['urlOptions']['queryGroupName'] => null,
            ],
        ];*/

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

        /*
        if ($params['enableRoot'] === self::ROOT_GROUP) {
            if (isset($params['urlOptions']['queryParams'])) {
                $root['url'] = ArrayHelper::merge(
                    $root['url'],
                    $params['urlOptions']['queryParams']);
            }

            array_unshift($result, $root);
        }
        */

        return $result ? $result : null;
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

    public function groupsDataRecursive($id, &$data)
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

    public function getDbData($modelClass)
    {
        $cacheKey = $modelClass;

        $dependency = new DbDependency([
            'sql' => 'SELECT MAX([[update_time]]) FROM ' . $modelClass::tableName(),
        ]);

        if (!$data = \Yii::$app->cache->get($cacheKey)) {
            $data = $modelClass::find()
                ->asArray()
                ->all();

            Yii::$app->cache->set($cacheKey, $data, 3600 * 24 * 12, $dependency);
        }

        return $data;
    }
}