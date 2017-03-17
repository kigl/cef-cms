<?php

namespace kigl\cef\module\page\components;

use Yii;
use kigl\cef\module\page\models\Page;

class PageRule implements \yii\web\UrlRuleInterface
{
    public $requestPage = 'page/default/view';

    public function createUrl($manager, $route, $params)
    {
        if (($route === $this->requestPage) && (isset($params['id']))) {
            $model = Page::find()
                ->select(['id', 'alias'])
                ->where('id = :id', [':id' => $params['id']])
                ->asArray()
                ->one();
            if ($model) {
                return $model['alias'];
            }
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        if (!empty($pathInfo) and (preg_match('/(^[^\/?&_]+)$/', $pathInfo))) {
            $model = Page::find()
                ->select(['id', 'alias'])
                ->where('alias = :query', [':query' => $pathInfo])
                ->asArray()
                ->one();

            if ($model) {
                return [$this->requestPage, ['id' => $model['id']]];
            }
        }
        return false;
    }
}
