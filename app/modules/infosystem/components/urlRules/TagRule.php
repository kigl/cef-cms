<?php
/**
 * Class TagRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\components\urlRules;


class TagRule extends Rule
{
    protected $urlItemName = 'tag';

    protected $routeAction = 'infosystem/item/tag';

    public function getUrl($route, $params)
    {
        if ($route !== $this->routeAction) {
            return false;
        }

        $url = '';

        $url .= $params['infosystem_id'] . '/' . $this->urlItemName . '/' . $params['name'];

        unset($params['infosystem_id'], $params['name']);

        return $this->builUrl($url, $params);
    }

    public function parseRequest($routeItem)
    {
        if ($routeItem[1] !== $this->urlItemName && empty($routeItem[2])) {
            return false;
        }

        return [$this->routeAction, [
            'name' => $routeItem[2],
            'infosystem_id' => $routeItem[0],
        ]];
    }
}