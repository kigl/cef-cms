<?php
/**
 * Class ItemRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


class ItemRule extends Rule
{
    protected $urlItemName = 'item';

    protected $routeAction = 'infosystems/item/view';

    public function getUrl($route, $params, $infosystems = [])
    {
        if ($route !== $this->routeAction) {
            return false;
        }

        $url = '';

        $infosystemCode = $infosystems[$params['infosystem_id']];

        $url .= $infosystemCode . '/' . $this->urlItemName . '/' . $params['id'] . '-' . $params['alias'];

        unset($params['alias'], $params['infosystem_id'], $params['id']);

        return $this->buildUrl($url, $params);
    }

    public function parseRequest($routeItem, $infosystems = [])
    {
        if (empty($routeItem[1]) && empty($routeItem[2])) {
            return false;
        }

        if ($routeItem[1] !== $this->urlItemName) {
            return false;
        }

        $params = [];

        if (preg_match('/(?<id>\d+)-(?<alias>\S+)/', $routeItem[2], $params) === 0) {
            return false;
        }

        return [
            $this->routeAction,
            [
                'id' => $params['id'],
                'alias' => $params['alias'],
                'infosystem_id' => array_search($routeItem[0], $infosystems)
            ]
        ];
    }
}