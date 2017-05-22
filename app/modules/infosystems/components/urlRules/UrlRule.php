<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:26
 */

namespace app\modules\infosystems\components\urlRules;


use Yii;
use yii\caching\DbDependency;
use yii\web\UrlRuleInterface;
use app\modules\infosystems\models\Infosystem;

class UrlRule implements UrlRuleInterface
{
    protected $cacheKey = 'infosystemCache';

    protected $rules = [];

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->rules = [
            'infosystem' => new InfosystemRule(),
            'group' => new GroupRule(),
            'item' => new ItemRule(),
            'tag' => new TagRule(),
        ];
    }

    public function createUrl($manager, $route, $params)
    {
        foreach ($this->rules as $rule) {
            if ($result = $rule->getUrl($route, $params)) {
                return $result;
            }
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $routeItem = explode('/', $request->getPathInfo());

        if (!array_key_exists($routeItem[0], $this->getInfosystems())) {
            return false;
        }

        foreach ($this->rules as $rule) {
            if ($result = $rule->parseRequest($routeItem)) {
                return $result;
            }
        }

        return false;
    }

    protected function getInfosystems()
    {
        $depedency = new DbDependency([
            'sql' => 'SELECT MAX(update_time) FROM ' . Infosystem::tableName(),
        ]);

        $duration = 3600 * 24 * 12;

        return Yii::$app->cache->getOrSet($this->cacheKey, function () {
            return Infosystem::find()
                ->asArray()
                ->indexBy('id')
                ->all();
        }, $duration, $depedency);
    }
}