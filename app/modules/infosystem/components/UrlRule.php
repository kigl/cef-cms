<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:26
 */

namespace app\modules\infosystem\components;


use Yii;
use yii\base\Object;
use yii\caching\DbDependency;
use yii\web\UrlRuleInterface;
use app\modules\infosystem\models\Infosystem;

class UrlRule extends Object implements UrlRuleInterface
{
    const URL_NAME_GROUP = 'group';
    const URL_NAME_ITEM = 'item';

    protected $cacheKey = 'infosystemCacheKeyUrlRule';

    protected $routeGroupAction = 'infosystem/group/view';
    protected $routeItemAction = 'infosystem/item/view';

    public function createUrl($manager, $route, $params)
    {
        if ($route == $this->routeGroupAction) {
            $controller = self::URL_NAME_GROUP;
        } elseIf ($route == $this->routeItemAction) {
            $controller = self::URL_NAME_ITEM;
        } else {
            return false;
        }

        $url = $params['infosystem_id'] . '/' . $controller .'/' . $params['id'] . '-' . $params['alias'];

        unset($params['alias'], $params['infosystem_id'], $params['id']);

        if (isset($params) && ($query = http_build_query($params)) != '') {
            $url .= '?' . $query;
        }

        return $url;
    }

    public function parseRequest($manager, $request)
    {
        $infosystem = $this->getInfosystems();
        $itemUrl = explode('/', $request->getPathInfo());

        $params = [];
        if (!array_key_exists($itemUrl[0], $infosystem)) {
            return false;
        }

        if (empty($itemUrl[1]) && empty($itemUrl[2])) {
            return false;
        }

        /**
         * @todo
         * добавить условие для отображения всех групп если не заполнены $params[1,2]
         */

        if (preg_match('/(?<id>\d+)-(?<alias>\S+)/', $itemUrl[2], $params) === 0) {
            return false;
        }

        $routeAction = '';

        if ($itemUrl[1] === self::URL_NAME_GROUP) {
            $routeAction = $this->routeGroupAction;
        } elseif ($itemUrl[1] === self::URL_NAME_ITEM) {
            $routeAction = $this->routeItemAction;
        }

        return [
            $routeAction,
            [
                'id' => $params['id'],
                'alias' => $params['alias'],
                'infosystem_id' => $itemUrl[0]
            ]
        ];
    }

    protected function getInfosystems()
    {
        $depedency = new DbDependency([
            'sql' => 'SELECT MAX(update_time) FROM ' . Infosystem::tableName(),
        ]);

        if (!$data = Yii::$app->cache->get($this->cacheKey)) {
            $data = Infosystem::find()
                ->asArray()
                ->indexBy('id')
                ->all();

            Yii::$app->cache->set($this->cacheKey, $data, 3600 * 24 * 12, $depedency);
        }
        return $data;
    }
}