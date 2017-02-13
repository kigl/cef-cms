<?php

namespace app\core\helpers;

use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

class Breadcrumbs
{
    const ROOT_GROUP = true;

    /**
     * @param null $id
     * $config = [
     *  'modelClass' => Model::className(),
     *  'enableRoot' => true,
     *  'urlOptions' => [
     *      'route' => 'controller/action',
     *      'params' => [param_id],
     *      'queryParams' => [
     *          'query' => 'views',
     *          ],
     *      ],
     * ],
     * @return array|null
     */
    public static function getLinksGroup($groupId = null, $config = [])
    {
        return (new self)->getLinksGroupData($groupId, $config);
    }

    public function getLinksGroupData($groupId = null, $config = [])
    {
        $data = $this->getGroupsData($config['modelClass']);
        $breadcrumbs = $this->groupsDataRecursive($groupId, $data);
        sort($breadcrumbs);

        $root = [
            'label' => Yii::t('app', 'Breadcrumbs root'),
            'url' => [
                $config['urlOptions']['route'],
                //$config['urlOptions']['queryGroupName'] => null,
            ],
        ];

        $result = [];
        foreach ($breadcrumbs as $key => $model) {
            $result[$key] = [
                'label' => $model['name'],
                'url' => $this->getUrl($model, $config['urlOptions']['route'], $config['urlOptions']['params']),
            ];

            if (isset($config['urlOptions']['queryParams'])) {
                $result[$key]['url'] = ArrayHelper::merge(
                    $result[$key]['url'],
                    $config['urlOptions']['queryParams']);
            }
        }

        if ($config['enableRoot'] === self::ROOT_GROUP) {
            if (isset($config['urlOptions']['queryParams'])) {
                $root['url'] = ArrayHelper::merge(
                    $root['url'],
                    $config['urlOptions']['queryParams']);
            }

            array_unshift($result, $root);
        }

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
        foreach ($data as $group) {
            if ($group['id'] == $id) {

                $result[] = $group;

                $result = ArrayHelper::merge($result, $this->groupsDataRecursive($group['parent_id'], $data));
            }
        }

        return $result;
    }

    public function getGroupsData($modelClass)
    {
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX([[update_time]]) FROM ' . $modelClass::tableName(),
        ]);

        $cacheKey = $modelClass;

        if (!$data = \Yii::$app->cache->get($cacheKey)) {
            $data = $modelClass::find()
                ->asArray()
                ->all();

            Yii::$app->cache->set($cacheKey, $data, 3600 * 24 * 12, $dependency);
        }

        return $data;
    }
}