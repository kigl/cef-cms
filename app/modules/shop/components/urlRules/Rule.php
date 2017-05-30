<?php
/**
 * Class Rule
 * @package app\modules\infosystem\components\urlRules
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\components\urlRules;


use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use app\modules\shop\models\Shop;

abstract class Rule
{
    protected $_shop = null;

    protected $_siteId;

    protected $cacheKey = 'shopCache';

    public function __construct()
    {
        $this->_siteId = Yii::$app->site->getId();

        $this->init();
    }

    public function init()
    {

    }

    protected function buildUrl($url = '', $params)
    {
        if ($query = http_build_query($params)) {
            $url .= '?' . $query;
        }

        return $url;
    }

    protected function getShopId($code)
    {
        $shops = $this->getShops();

        if ($this->hasShopCode($code)) {
            return array_search($code, $shops[$this->_siteId]);
        }

        return null;
    }

    protected function getShopCode($id)
    {
        $shops = $this->getShops();

        if ($this->hasShopId($id)) {
            return $shops[$this->_siteId][$id];
        }

        return null;
    }

    protected function getShops()
    {
        $depedency = new DbDependency([
            'sql' => 'SELECT MAX(update_time) FROM ' . Shop::tableName(),
        ]);

        $duration = 3600 * 24 * 12;

        if (is_null($this->_shop)) {

            $data = Yii::$app->cache->getOrSet($this->cacheKey, function () {
                return Shop::find()
                    ->select(['id', 'code', 'site_id'])
                    ->asArray()
                    ->all();
            }, $duration, $depedency);

            $this->_shop = ArrayHelper::map($data, 'id', 'code', 'site_id');
        }

        return $this->_shop;
    }

    protected function hasShopCode($code)
    {
        $shops = $this->getShops();

        if (isset($shops[$this->_siteId]) && array_search($code, $shops[$this->_siteId])) {
            return true;
        }

        return false;
    }

    protected function hasShopId($id)
    {
        $shops = $this->getShops();

        return isset($shops[$this->_siteId][$id]) ? true: false;
    }
}