<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:26
 */

namespace app\modules\infosystems\components\urlRules;


use Yii;
use yii\web\UrlRuleInterface;

class UrlRule extends Rule implements UrlRuleInterface
{
    protected $rules = [];

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

        if (!$this->hasInfosystemCode($routeItem[0])) {
            return false;
        }

        foreach ($this->rules as $rule) {
            if ($result = $rule->parseRequest($routeItem)) {
                return $result;
            }
        }

        return false;
    }
}