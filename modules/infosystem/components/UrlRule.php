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

    protected $groupAction = 'infosystem/group/view';
    protected $itemAction = 'infosystem/item/view';

    public function createUrl($manager, $route, $params)
    {

        if ($route == $this->groupAction) {

            $url = $params['infosystem_id'] . '/group/' . $params['id'] . '-' . $params['alias'];
            unset($params['alias'], $params['infosystem_id'], $params['id']);

            if ($params) {
                $url.= '?' . http_build_query($params);
            }
            return $url;
        } elseIf ($route == $this->itemAction) {

            $url = $params['infosystem_id'] . '/item/' . $params['id'] . '-' . $params['alias'];
            unset($params['alias'], $params['infosystem_id'], $params['id']);

            if ($params) {
                $url.= '?' . http_build_query($params);
            }
            return $url;
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $infosystem = $this->getInfosystems();
        $itemUrl = explode('/', $request->getPathInfo());

        $params = [];
        $patternParseParams = '/\/(?<id>\d+)-(?<alias>\S+)/';

        if (array_key_exists($itemUrl[0], $infosystem) && !empty($itemUrl[1])) {
            if (($itemUrl[1] === self::URL_NAME_GROUP)
                && preg_match($patternParseParams, $request->getPathInfo(), $params)
            ) {

                return [
                    $this->groupAction,
                    [
                        'id' => $params['id'],
                        'alias' => $params['alias'],
                        'infosystem_id' => $itemUrl[0]
                    ]
                ];
            } elseif (($itemUrl[1] === self::URL_NAME_ITEM)
                && preg_match($patternParseParams, $request->getPathInfo(), $params)
            ) {

                return [
                    $this->itemAction,
                    [
                        'id' => $params['id'],
                        'alias' => $params['alias'],
                        'infosystem_id' => $itemUrl[0]
                    ]
                ];
            }
        }

        return false;
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