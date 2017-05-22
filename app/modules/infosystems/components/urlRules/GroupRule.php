<?php
/**
 * Class GroupRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


class GroupRule extends Rule
{
    protected $urlItemName = 'group';

    protected $routeAction = 'infosystems/group/view';

    public function getUrl($route, $params)
    {
        if ($route !== $this->routeAction) {

            return false;
        }

        $url = '';

        $url .= $params['infosystem_id'] . '/' . $this->urlItemName . '/' . $params['id'] . '-' . $params['alias'];

        unset($params['alias'], $params['infosystem_id'], $params['id']);

        return $this->builUrl($url, $params);
    }

    public function parseRequest($routeItem)
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
                'infosystem_id' => $routeItem[0]
            ]
        ];
    }
}