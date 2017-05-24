<?php
/**
 * Class Rule
 * @package app\modules\infosystem\components\urlRules
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use app\modules\infosystems\models\Infosystem;

abstract class Rule
{
    protected $_infosystems = null;

    protected $_siteId;

    protected $cacheKey = 'infosystemCache';

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

    protected function getInfosystemId($code)
    {
        $infosystems = $this->getInfosystems();

        if ($this->hasInfosystemCode($code)) {
            return array_search($code, $infosystems[$this->_siteId]);
        }

        return null;
    }

    protected function getInfosystemCode($id)
    {
        $infosystems = $this->getInfosystems();

        if ($this->hasInfosystemId($id)) {
            return $infosystems[$this->_siteId][$id];
        }

        return null;
    }

    protected function getInfosystems()
    {
        $depedency = new DbDependency([
            'sql' => 'SELECT MAX(update_time) FROM ' . Infosystem::tableName(),
        ]);

        $duration = 3600 * 24 * 12;

        if (is_null($this->_infosystems)) {

            $data = Yii::$app->cache->getOrSet($this->cacheKey, function () {
                return Infosystem::find()
                    ->select(['id', 'code', 'site_id'])
                    ->asArray()
                    ->all();
            }, $duration, $depedency);

            $this->_infosystems = ArrayHelper::map($data, 'id', 'code', 'site_id');
        }

        return $this->_infosystems;
    }

    protected function hasInfosystemCode($code)
    {
        $infosystems = $this->getInfosystems();

        if (isset($infosystems[$this->_siteId]) && array_search($code, $infosystems[$this->_siteId])) {
            return true;
        }

        return false;
    }

    protected function hasInfosystemId($id)
    {
        $infosystems = $this->getInfosystems();

        return isset($infosystems[$this->_siteId][$id]) ? true: false;
    }
}