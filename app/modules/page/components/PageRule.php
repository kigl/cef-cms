<?php

namespace app\modules\page\components;


use Yii;
use yii\caching\DbDependency;
use app\modules\page\models\Page;

class PageRule implements \yii\web\UrlRuleInterface
{
    public $requestPage = 'page/default/view';

    protected $cacheKey = 'pageCacheKey';

    protected $data = null;

    public function createUrl($manager, $route, $params)
    {
        if (($route === $this->requestPage) && (isset($params['id']))) {
            $models = $this->getData();

            if (key_exists($params['id'], $models)) {
                return $models[$params['id']]['alias'];
            }
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        if (!empty($pathInfo) and (preg_match('/(^[^\/?&_]+)$/', $pathInfo))) {

            foreach ($this->getData() as $model) {

                if ($model['alias'] == $pathInfo) {
                    return [$this->requestPage, ['id' => $model['id']]];
                }
            }
        }
        return false;
    }

    protected function getData()
    {
        if (is_null($this->data)) {
            $depedency = new DbDependency([
                'sql' => 'SELECT MAX(update_time) FROM ' . Page::tableName(),
            ]);

            $this->data = Yii::$app->cache->getOrSet($this->cacheKey, function () {
                return Page::find()
                    ->indexBy('id')
                    ->select(['id', 'alias'])
                    ->asArray()
                    ->all();
            }, null, $depedency);
        }

        return $this->data;
    }
}
