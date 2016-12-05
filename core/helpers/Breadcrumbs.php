<?php

namespace app\core\helpers;

use Yii;
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
     *  'enableQueryGroupAlias' => true,
     *  'urlOptions' => [
     *      'route' => 'controller/action',
     *      'queryGroupName' => name_id,
     *      'queryParams' => [
     *          'query' => 'value',
     *  ],
     * ],
     * ],
     *  $urlOptions => [
     *              'route' => 'controller/action',
     *              'queryParams' => [
     *                  'query' => 'value'
     *              ],
     * @return array|null
     */
    public static function getLinksGroup($id = null, $config = [])
    {
        if (!isset($config['enableRoot'])) {
            $config['enableRoot'] = self::ROOT_GROUP;
        }

        if (!isset($config['enableQueryGroupAlias'])) {
            $config['enableQueryGroupAlias'] = self::QUERY_GROUP_ALIAS;
        }

        $result = [];
        $breadcrumbs = self::recursive($id, $config['modelClass'], $config['enableQueryGroupAlias']);

        $root = [
            'label' => Yii::t('admin', 'Breadcrumbs root'),
            'url' => [
                $config['urlOptions']['route'],
                $config['urlOptions']['queryGroupName'] => 0,
            ],
        ];


        foreach ($breadcrumbs as $key => $model) {
            $result[$key] = [
                'label' => $model['name'],
                'url' => [
                    $config['urlOptions']['route'],
                    $config['urlOptions']['queryGroupName'] => $config['enableQueryGroupAlias'] ? $model['alias'] : $model['id'],
                ]
            ];

            if (isset($config['urlOptions']['route']['queryParams'])) {
                $result[$key]['url'] = ArrayHelper::merge(
                    $result[$key]['url'],
                    $config['urlOptions']['route']['queryParams']);
            }
        }

        /*
         * @todo
        // уберем из последнего элемента группы ссылкку
        $end = end($result);
        unset($end['url']);
        array_pop($result);
        array_push($result, $end);
        */

        if ($config['enableRoot'] === self::ROOT_GROUP) {
            array_unshift($result, $root);
        }

        return (!empty($result)) ? $result : null;
    }

    /**
     * Рекурсивная функция для построение массива
     * @param integer $id
     *
     * @return array | false
     */
    protected static function recursive($id, $modelClass, $alias = false)
    {
        $model = $modelClass::find();
        $model->select(['id', 'parent_id', 'name']);
        if ($alias) {
            $model->addSelect('alias');
        }
        $model->where('id = :id', [':id' => $id])
            ->asArray();

        $model = $model->one();

        if ($model) {
            $result = self::recursive($model['parent_id'], $modelClass, $alias);

            $result[] = [
                'id' => $model['id'],
                'parent_id' => $model['parent_id'],
                'name' => $model['name'],
                'alias' => $alias ? $model['alias'] : null,
            ];
        }

        return (!empty($result)) ? $result : [];
    }
}