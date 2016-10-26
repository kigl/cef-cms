<?php

namespace app\components\helpers;

use Yii;
use yii\helpers\ArrayHelper;

class Breadcrumbs
{

    /**
     * @param null $id
     * @param array $urlOptions
     *  $urlOptions => [
     *              'route' => 'controller/action',
     *              'queryParams' => [
     *                  'query' => 'value'
     *              ],
     * @param $modelClass
     * @return array|null
     */
    public static function getLinksGroup($id = null, array $urlOptions, $modelClass)
    {
        $result = [];
        $breadcrumbs = self::recursive($id, $modelClass);

        $root = [
            'label' => Yii::t('admin', 'Breadcrumbs root'),
            'url' => [
                $urlOptions['route'],
                'parent_id' => 0,
            ],
        ];


        foreach ($breadcrumbs as $key => $model) {
            $result[$key] = [
                'label' => $model['name'],
                'url' => [
                    $urlOptions['route'],
                    'parent_id' => $model['id'],
                ]
            ];

            if (isset($urlOptions['queryParams'])) {
                $result[$key]['url'] = ArrayHelper::merge(
                    $result[$key]['url'],
                    $urlOptions['queryParams']);
            }
        }

        array_unshift($result, $root);

        return (!empty($result)) ? $result : null;
    }

    /**
     * Рекурсивная функция для построение массива
     * @param integer $id
     *
     * @return array | false
     */
    protected static function recursive($id, $modelClass)
    {
        $model = $modelClass::find()
            ->select(['id', 'parent_id', 'name'])
            ->where('id = :id', [':id' => $id])
            ->asArray()
            ->one();

        if ($model) {
            $result = self::recursive($model['parent_id'], $modelClass);

            $result[] = [
                'id' => $model['id'],
                'parent_id' => $model['parent_id'],
                'name' => $model['name'],
            ];
        }

        return (!empty($result)) ? $result : [];
    }
}