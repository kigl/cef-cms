<?php
/**
 * Class GroupRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


use Yii;

class GroupRule extends Rule
{
    protected $_urlItemName = 'group';

    protected $_routeAction = 'infosystems/group/view';

    public function getUrl($route, $params)
    {
        if ($route !== $this->_routeAction) {

            return false;
        }

        $infosystemCode = $this->getInfosystemCode($params['infosystem_id']);

        $url = '';

        $url .= $infosystemCode . '/' . $this->_urlItemName . '/' . $params['id'] . '-' . $params['alias'];

        unset($params['alias'], $params['infosystem_id'], $params['id']);

        return $this->buildUrl($url, $params);
    }

    public function parseRequest($routeItem)
    {
        if (empty($routeItem[1]) && empty($routeItem[2])) {
            return false;
        }

        if ($routeItem[1] !== $this->_urlItemName) {
            return false;
        }

        $params = [];
        if (preg_match('/(?<id>\d+)-(?<alias>\S+)/', $routeItem[2], $params) === 0) {
            return false;
        }

        return [
            $this->_routeAction,
            [
                'id' => $params['id'],
                'alias' => $params['alias'],
                'infosystem_id' => $this->getInfosystemId($routeItem[0])
            ]
        ];
    }
}