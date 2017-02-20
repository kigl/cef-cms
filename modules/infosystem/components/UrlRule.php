<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:26
 */

namespace app\modules\infosystem\components;


use app\modules\infosystem\models\Infosystem;
use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use yii\web\UrlRuleInterface;

class UrlRule implements UrlRuleInterface
{
    protected $cacheKey = 'infosystemCacheKeyUrlRule';
    protected $groupRule = '/infosystem/group/view';
    protected $elementRule = '/infosystem/element/view';
    
    public function createUrl($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $data = $this->getData();
        
        $pathInfo = explode('/', $request->getPathInfo());
        if (array_key_exists($pathInfo[0], $data) && !empty($pathInfo[1])) {
            if ($pathInfo[1] === 'group' && (isset($pathInfo[2]))) {
                return [$this->groupRule, ['id' => $pathInfo[2]]];
            }
        }

        return false;
    }

    protected function getData()
    {
        $depedency = new DbDependency([
            'sql' => 'SELECT MAX(update_time) FROM ' . Infosystem::tableName(),
        ]);

        if (!$data = Yii::$app->cache->get($this->cacheKey)) {
            $data = Infosystem::find()
                ->asArray()
                ->indexBy('name')
                ->all();

            Yii::$app->cache->set($this->cacheKey, $data, 3600 * 24 * 12, $depedency);
        }

        return $data;
    }
}