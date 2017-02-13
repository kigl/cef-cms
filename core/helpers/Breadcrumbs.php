<?php

namespace app\core\helpers;

use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

class Breadcrumbs
{
    const ROOT_GROUP = true;
    const QUERY_GROUP_ALIAS = false;

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
     *  ],
     * ],
     * ],
     * @return array|null
     */
    public static function getLinksGroup($groupId = null, $config = [])
    {
        if (!isset($config['enableQueryGroupAlias'])) {
            $config['enableQueryGroupAlias'] = self::QUERY_GROUP_ALIAS;
        }

        $result = [];
        $data = self::getGroupsData($config['modelClass']);
        $breadcrumbs = self::groupsDataRecursive($groupId, $data);

        $root = [
            'label' => Yii::t('app', 'Breadcrumbs root'),
            'url' => [
                $config['urlOptions']['route'],
                //$config['urlOptions']['queryGroupName'] => null,
            ],
        ];

        foreach ($breadcrumbs as $key => $model) {
            $result[$key] = [
                'label' => $model['name'],
                'url' => self::getUrl($model, $config['urlOptions']['route'], $config['urlOptions']['params']),
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

        return (!empty($result)) ? $result : null;
    }

    protected static function getUrl($model, $route, $params = [])
    {
        $result = [];

        foreach ($params as $param) {
            $result[$param] = $model[$param];
        }

        array_unshift($result, $route);

        return $result;
    }

    public static function groupsDataRecursive($id, &$data)
    {
        $result = [];
        foreach ($data as $group) {
            if ($group['id'] == $id) {
                $result = self::groupsDataRecursive($group['parent_id'], $data);

                $result[] = $group;
            }
        }

        return $result;
    }

    public static function getGroupsData($modelClass)
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