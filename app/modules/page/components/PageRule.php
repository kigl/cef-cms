<?php

namespace app\modules\page\components;

use Yii;
use app\modules\page\models\Page;

class PageRule implements \yii\web\UrlRuleInterface
{
    public $pageRequest = 'page/default/view';

    public function createUrl($manager, $route, $params)
    {
        if (($route === $this->pageRequest) and (isset($params['id']))) {
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
        $queryId = $request->getQueryParam('id');

        if (!empty($pathInfo) and (preg_match('/(^[^\/?&_]+)$/', $pathInfo))) {
            $model = Page::find()
                ->select(['id', 'alias'])
                ->where('alias = :query', [':query' => $pathInfo])
                ->asArray()
                ->one();

            if ($model) {
                ;
                return [$this->pageRequest, ['id' => $model['id']]];
            }
        }
        return false;
    }
}
